<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;

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

}
