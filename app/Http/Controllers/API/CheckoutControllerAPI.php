<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Produk;

class CheckoutControllerAPI extends Controller
{
    public function checkout(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:form_users,id',
            'cart_id' => 'required|exists:carts,id',
        ]);

        // Ambil keranjang dengan itemnya
        $cart = Cart::with('items.produk')
                    ->where('user_id', $request->user_id)
                    ->where('id', $request->cart_id)
                    ->first();

        if (!$cart || $cart->items->isEmpty()) {
            return response()->json(['message' => 'Keranjang tidak ditemukan atau kosong'], 404);
        }

        // Buat pesanan baru
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_price' => $cart->totalPrice(),
            'status' => 'pending',
        ]);

        // Pindahkan item keranjang ke order_items
        foreach ($cart->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'produk_id' => $item->produk_id,
                'quantity' => $item->quantity,
                'price' => $item->produk->harga,
            ]);
        }

        // Kosongkan keranjang
        $cart->items()->delete();

        return response()->json([
            'message' => 'Checkout berhasil',
            'order_id' => $order->id,
        ]);
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

public function getUserOrders($user_id)
{
    $orders = Order::with('items.produk', 'user')
                   ->where('user_id', $user_id)
                   ->get();

    if ($orders->isEmpty()) {
        return response()->json(['message' => 'Tidak ada pesanan'], 404);
    }

    $orders = $orders->map(function ($order) {
        $order->username = $order->user->name;  // Asumsi nama kolom 'name' di tabel 'users' adalah username
        unset($order->user);  // Menghapus objek 'user' agar hanya 'username' yang tampil
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
        $order->status = $request->status;
        $order->save();

        return response()->json(['message' => 'Status pesanan berhasil diperbarui']);
    }
}