<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CartItem;
use App\Models\Cart;

class CartItemControllerAPI extends Controller
{
    // Tambahkan item ke Cart
    public function addItem(Request $request)
    {
        $request->validate([
            'cart_id' => 'required|exists:carts,id',
            'produk_id' => 'required|exists:produk,id',
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::where('cart_id', $request->cart_id)
                            ->where('produk_id', $request->produk_id)
                            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->quantity;
            $cartItem->save();
        } else {
            CartItem::create($request->only('cart_id', 'produk_id', 'quantity'));
        }

        return response()->json(['message' => 'Item berhasil ditambahkan ke keranjang'], 201);
    }

    // Perbarui item di Cart
    public function updateItem(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = CartItem::findOrFail($id);
        $cartItem->quantity     = $request->quantity;
        $cartItem->save();

        return response()->json(['message' => 'Item berhasil diperbarui']);
    }

    // Hapus item dari Cart
    public function removeItem($id)
    {
        $cartItem = CartItem::findOrFail($id);
        $cartItem->delete();

        return response()->json(['message' => 'Item berhasil dihapus']);
    }

    // Ambil semua item berdasarkan Cart ID
    public function getItemsByCart($cart_id)
    {
        $cartItems = CartItem::where('cart_id', $cart_id)
                             ->with('produk') // Sertakan informasi produk
                             ->get();

        if ($cartItems->isEmpty()) {
            return response()->json(['message' => 'Tidak ada item di keranjang'], 404);
        }

        return response()->json($cartItems);
    }
}

