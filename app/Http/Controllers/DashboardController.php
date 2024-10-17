<?php

namespace App\Http\Controllers;

use App\Models\FormUser;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //

    public function _construct(Request $request){
        if (empty($request->session()->get('nama')))
    
            return Redirect('/')->send();
        // return back()->withInput();
    }

    public function index(Request $request) {
        $data = FormUser::all();
        return view('dashboard', ['title' => 'Dashboard','data'=> $data]);
    }
}
