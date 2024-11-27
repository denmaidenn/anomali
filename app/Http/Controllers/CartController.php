<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cart;

class CartController extends Controller
{
    //

    public function index()
    {
        // Load all feedback entries with associated user data
        $cart = cart::all();
        return view('cart.index', ['title' => 'Feedback', 'cart' => $cart]);
    }
}
