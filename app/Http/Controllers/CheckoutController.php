<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;

class CheckoutController extends Controller
{
    //

    public function index()
    {
        // Load all feedback entries with associated user data
        $order = Order::all();
        return view('checkout.index', ['title' => 'Checkout', 'order' => $order]);
    }
}
