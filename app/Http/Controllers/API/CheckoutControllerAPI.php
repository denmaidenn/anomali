<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produk;
use Midtrans\Config;
use Midtrans\Snap;
use Illuminate\Support\Facades\Log;


class CheckoutControllerAPI extends Controller
{
    public function __construct()
    {
        // Konfigurasi Midtrans
        Config::$serverKey = config('midtrans.server_key');
        Config::$isProduction = config('midtrans.is_production');
        Config::$isSanitized = true;
        Config::$is3ds = true;
    }

    public function checkout(Request $request)
    {
        // Validasi input
        $request->validate([
            'user_id' => 'required|exists:form_users,id',
            'cart_id' => 'required|exists:carts,id',
        ]);

        // Ambil keranjang beserta item-nya
        $cart = Cart::with('items.produk')
            ->where('user_id', $request->user_id)
            ->where('id', $request->cart_id)
            ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['message' => 'Keranjang tidak ditemukan atau kosong'], 404);
        }

        // Hitung total harga dari keranjang
        $totalPrice = $cart->items->sum(function ($item) {
            return $item->produk->harga * $item->quantity;
        });

        // Buat pesanan baru
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $totalPrice,
            'status' => 'pending',
        ]);

        // Pindahkan item dari keranjang ke tabel order_items
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'produk_id' => $item->produk_id,
                'quantity' => $item->quantity,
                'price' => $item->produk->harga,
            ]);
        }

        // Siapkan data untuk transaksi Midtrans
        $params = [
            'transaction_details' => [
                'order_id' => (string) $order->id,
                'gross_amount' => (int) $totalPrice,
            ],
            'customer_details' => [
                'first_name' => strtok($cart->user->full_name, ' '),
                'last_name' => trim(strstr($cart->user->full_name, ' ') ?: ''),
                'email' => $cart->user->email,
                'phone' => $cart->user->phone_number,
            ],
            'item_details' => $cart->items->map(function ($item) {
                return [
                    'id' => $item->produk->id,
                    'price' => $item->produk->harga,
                    'quantity' => $item->quantity,
                    'name' => $item->produk->nama_produk,
                ];
            })->toArray(),
        ];

        // Buat transaksi di Midtrans dan dapatkan snap token
        try {
            $snapResponse = Snap::createTransaction($params);

            $order->update([
                'snap_token' => $snapResponse->token,
                'payment_url' => $snapResponse->redirect_url,
            ]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Gagal membuat transaksi: ' . $e->getMessage()], 500);
        }

        // Kosongkan keranjang
        $cart->items()->delete();

        // Berikan respons berhasil
        return response()->json([
            'message' => 'Checkout berhasil',
            'order_id' => $order->id,
            'snap_token' => $order->snap_token,
            'payment_url' => $order->payment_url,
        ], 201);
    }



    public function notification(Request $request)
    {
        try {
            // Log request awal untuk debugging
            Log::info('Midtrans Notification Received:', [
                'raw_request' => $request->all(),
                'raw_content' => $request->getContent()
            ]);
    
            // Decode notifikasi dari Midtrans
            $notification = json_decode($request->getContent(), true);
    
            // Pastikan data notifikasi memiliki field penting
            if (!isset($notification['order_id']) || !isset($notification['transaction_status'])) {
                return response()->json(['message' => 'Invalid notification data'], 400);
            }
    
            // Cari pesanan berdasarkan order_id
            $order = Order::find($notification['order_id']);
            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }
    
            // Map status Midtrans ke status di tabel orders
            $statusMapping = [
                'capture' => 'paid',       // Jika pembayaran berhasil dicapture
                'settlement' => 'paid',    // Jika pembayaran sukses
                'pending' => 'pending',    // Jika pembayaran masih menunggu
                'deny' => 'failed',        // Jika pembayaran ditolak
                'expire' => 'expired',     // Jika pembayaran sudah kadaluarsa
                'cancel' => 'canceled',    // Jika pembayaran dibatalkan
            ];
    
            $newStatus = $statusMapping[$notification['transaction_status']] ?? 'pending';
    
            // Perbarui status pesanan
            $order->update([
                'status' => $newStatus,
                'paid_at' => $newStatus === 'paid' ? now() : null,
            ]);
    
            Log::info('Order status updated:', [
                'order_id' => $order->id,
                'new_status' => $newStatus,
            ]);
    
            return response()->json(['message' => 'Notification processed successfully'], 200);
        } catch (\Exception $e) {
            Log::error('Failed to process Midtrans notification:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
            ]);
            return response()->json(['message' => 'Failed to process notification'], 500);
        }
    }
    


    public function directCheckout(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:form_users,id',
        'items' => 'required|array|min:1', // Array produk
        'items.*.produk_id' => 'required|exists:produk,id', // ID Produk
        'items.*.quantity' => 'required|integer|min:1', // Kuantitas
    ]);

    // Hitung total harga pesanan
    $totalPrice = 0;
    $orderItems = [];
    foreach ($request->items as $item) {
        $produk = Produk::findOrFail($item['produk_id']);
        $orderItems[] = [
            'produk_id' => $produk->id,
            'quantity' => $item['quantity'],
            'price' => $produk->harga,
        ];
        $totalPrice += $produk->harga * $item['quantity'];
    }

    // Buat pesanan baru
    $order = Order::create([
        'user_id' => $request->user_id,
        'total_price' => $totalPrice,
        'status' => 'pending',
    ]);

    // Simpan item ke dalam tabel order_items
    foreach ($orderItems as $orderItem) {
        OrderItem::create([
            'order_id' => $order->id,
            'produk_id' => $orderItem['produk_id'],
            'quantity' => $orderItem['quantity'],
            'price' => $orderItem['price'],
        ]);
    }

    return response()->json([
        'message' => 'Checkout berhasil',
        'order_id' => $order->id,
        'total_price' => $totalPrice,
    ], 201);
}

public function checkoutMultiple(Request $request)
{
    $request->validate([
        'user_id' => 'required|exists:form_users,id',
        'cart_id' => 'required|exists:carts,id',
        'selected_items' => 'required|array|min:1', // Daftar item cart
        'selected_items.*.cart_item_id' => 'required|exists:cart_items,id', // ID dari item di keranjang
    ]);

    // Ambil keranjang dengan itemnya
    $cart = Cart::with('items.produk')
                ->where('id', $request->cart_id)
                ->where('user_id', $request->user_id)
                ->first();

    if (!$cart) {
        return response()->json(['message' => 'Keranjang tidak ditemukan'], 404);
    }

    $selectedItems = $request->selected_items;
    $orderItems = [];
    $totalPrice = 0;

    foreach ($selectedItems as $selectedItem) {
        // Ambil item berdasarkan cart_item_id
        $cartItem = $cart->items->where('id', $selectedItem['cart_item_id'])->first();

        if ($cartItem) {
            $orderItems[] = [
                'produk_id' => $cartItem->produk_id,
                'quantity' => $cartItem->quantity,
                'price' => $cartItem->produk->harga,
            ];
            $totalPrice += $cartItem->produk->harga * $cartItem->quantity;

            // Hapus item dari keranjang
            $cartItem->delete();
        }
    }

    if (empty($orderItems)) {
        return response()->json(['message' => 'Tidak ada item valid untuk checkout'], 400);
    }

    // Buat pesanan baru
    $order = Order::create([
        'user_id' => $request->user_id,
        'total_price' => $totalPrice,
        'status' => 'pending',
    ]);

    // Simpan item ke tabel order_items
    foreach ($orderItems as $item) {
        OrderItem::create([
            'order_id' => $order->id,
            'produk_id' => $item['produk_id'],
            'quantity' => $item['quantity'],
            'price' => $item['price'],
        ]);
    }

    return response()->json([
        'message' => 'Checkout berhasil',
        'order_id' => $order->id,
        'total_price' => $totalPrice,
    ], 201);
}



public function getUserOrders($user_id)
{
    $orders = Order::with(['items.produk', 'user'])
                   ->where('user_id', $user_id)
                   ->get();

    if ($orders->isEmpty()) {
        return response()->json(['message' => 'Tidak ada pesanan'], 404);
    }

    $orders = $orders->map(function ($order) {
        $order->username = $order->user->name;  
        $order->alamat_pengiriman = $order->user->alamat;  // Ambil alamat dari user
        $order->no_telp = $order->user->no_telp;          // Ambil no_telp dari user
        unset($order->user);  // Hapus objek user setelah mengambil data yang diperlukan
        return $order;
    });

    return response()->json($orders);
}

public function getOrderDetail($order_id)
{
    $order = Order::with('items.produk', 'user')
                  ->where('id', $order_id)
                  ->first();

    if (!$order) {
        return response()->json(['message' => 'Pesanan tidak ditemukan'], 404);
    }

    return response()->json($order);
}


  

public function updateOrderStatus(Request $request, $order_id)
{
    $request->validate([
        'status' => 'required|in:pending,paid,shipped,completed,canceled',
    ]);

    $order = Order::findOrFail($order_id);
    $order->update(['status' => $request->status]);

    return response()->json([
        'success' => true,
        'message' => 'Status berhasil diperbarui.',
        'data' => $order
    ], 200);
}

public function delete($id)
{
    $checkout = Order::findOrFail($id);
    $checkout->delete();

    return response()->json([
        'success' => true,
        'message' => 'Data checkout berhasil dihapus.'
    ], 200);
}

    public function getUsersWhoCheckedOut(Request $request)
    {
        // Ambil parameter status dari request (opsional)
        $status = $request->query('status');
    
        // Query pesanan dengan relasi user dan item
        $ordersQuery = Order::with(['items.produk', 'user']);
    
        // Jika ada parameter status, tambahkan filter berdasarkan status
        if ($status) {
            $ordersQuery->where('status', $status);
        }
    
        // Ambil semua data pesanan
        $orders = $ordersQuery->get();
    
        // Jika tidak ada data pesanan
        if ($orders->isEmpty()) {
            return response()->json([
                'success' => false,
                'message' => 'Tidak ada pesanan yang ditemukan.'
            ], 404);
        }
    
        // Format data pesanan
        $formattedOrders = $orders->map(function ($order) {
            return [
                'id' => $order->id,
                'user_id' => $order->user_id,
                'total_price' => $order->total_price,
                'status' => $order->status,
                'created_at' => $order->created_at->toIso8601String(),
                'updated_at' => $order->updated_at->toIso8601String(),
                'username' => $order->user->name,
                'email' => $order->user->email, // Menambahkan email pengguna
                'items' => $order->items->map(function ($item) {
                    return [
                        'id' => $item->id,
                        'order_id' => $item->order_id,
                        'produk_id' => $item->produk_id,
                        'quantity' => $item->quantity,
                        'price' => $item->price,
                        'created_at' => $item->created_at->toIso8601String(),
                        'updated_at' => $item->updated_at->toIso8601String(),
                        'produk' => [
                            'id' => $item->produk->id,
                            'nama_produk' => $item->produk->nama_produk,
                            'deskripsi_produk' => $item->produk->deskripsi_produk,
                            'gambar_produk' => $item->produk->gambar_produk,
                            'stok' => $item->produk->stok,
                            'harga' => $item->produk->harga,
                            'kategori' => $item->produk->kategori,
                            'created_at' => $item->produk->created_at->toIso8601String(),
                            'updated_at' => $item->produk->updated_at->toIso8601String(),
                        ]
                    ];
                })
            ];
        });
    
        // Mengembalikan data dalam format JSON
        return response()->json([
            'success' => true,
            'message' => 'Data pesanan berhasil diambil',
            'data' => $formattedOrders
        ]);
    }

    
    
}
