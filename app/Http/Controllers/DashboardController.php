<?php

namespace App\Http\Controllers;

use App\Models\FormUser;
use App\Models\Fish;
use Illuminate\Http\Request;
use Illuminate\Container\Attributes\Auth;

class DashboardController extends Controller
{
    //

   

    public function index(Request $request) {
        $data = FormUser::all();
        $fish = Fish::all();
        return view('dashboard', ['title' => 'Dashboard','data'=> $data, 'fish'=> $fish]);
    }
}
