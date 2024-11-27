<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\FormUser;

class CartControllerAPI extends Controller
{
    public function addToCart(Request $request)
    {
        $request->validate([
            'user_id' => 'required|exists:form_users,id',
            'produk_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1',
        ]);

        // Cari atau buat keranjang untuk user
        $cart = Cart::firstOrCreate(['user_id' => $request->user_id]);

        // Cek jika produk sudah ada di cart_items
        $cartItem = $cart->items()->where('produk_id', $request->produk_id)->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            $cart->items()->create([
                'produk_id' => $request->produk_id,
                'quantity' => $request->quantity,
            ]);
        }

        return response()->json(['message' => 'Produk berhasil ditambahkan ke keranjang'], 201);
    }

    public function viewCartWithItems($user_id)
    {
        $cart = Cart::with('items.produk')
                    ->where('user_id', $user_id)
                    ->first();

        if (!$cart) {
            return response()->json(['message' => 'Keranjang kosong'], 404);
        }

        return response()->json([
            'cart' => $cart,
            'total_quantity' => $cart->totalQuantity(),
            'total_price' => $cart->totalPrice(),
        ]);
    }

    public function removeFromCart($id)
    {
        $cartItem = CartItem::findOrFail($id); // Menghapus item, bukan cart
        $cartItem->delete();

        return response()->json(['message' => 'Produk berhasil dihapus dari keranjang']);
    }


    public function getCart($userId)
    {
        try {
            // Ambil data keranjang berdasarkan user_id
            $cartItems = Cart::with('produk') // Pastikan relasi produk sudah didefinisikan di model Cart
                ->where('user_id', $userId)
                ->get();

            if ($cartItems->isEmpty()) {
                return response()->json([
                    'success' => true,
                    'cart' => [
                        'items' => []
                    ]
                ]);
            }

            return response()->json([
                'success' => true,
                'cart' => [
                    'items' => $cartItems
                ]
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal mengambil data keranjang.',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function viewUserCart($userId)
{
    $cart = Cart::with('items.produk')->where('user_id', $userId)->first();

    if (!$cart) {
        return response()->json([
            'success' => true,
            'cart' => [
                'user_name' => FormUser::find($userId)->name ?? 'Unknown User',
                'items' => [],
            ],
        ]);
    }

    return response()->json([
        'success' => true,
        'cart' => [
            'user_name' => $cart->user->name,
            'items' => $cart->items->map(function ($item) {
                return [
                    'produk' => $item->produk,
                    'quantity' => $item->quantity,
                ];
            }),
        ],
    ]);
}

public function getUsersWithCarts()
{
    $users = FormUser::with(['cart.items.produk'])->get();

    $data = $users->map(function ($user) {
        return [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'cart' => $user->cart ? [
                'id' => $user->cart->id,
                'total_quantity' => $user->cart->items->sum('quantity'),
                'total_price' => $user->cart->items->sum(function ($item) {
                    return $item->quantity * $item->produk->harga;
                }),
                'items' => $user->cart->items->map(function ($item) {
                    return [
                        'produk_id' => $item->produk_id,
                        'produk_name' => $item->produk->nama_produk,
                        'quantity' => $item->quantity,
                        'price' => $item->produk->harga,
                        'subtotal' => $item->quantity * $item->produk->harga,
                    ];
                }),
            ] : null,
        ];
    });

    return response()->json([
        'success' => true,
        'message' => 'Users with carts retrieved successfully',
        'data' => $data
    ], 200);
}






}
