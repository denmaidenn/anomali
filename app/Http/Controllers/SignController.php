<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class SignController extends Controller
{
    //

    public function index() {
        return view('sign.index');
    }
    
    public function in(Request $request) {
        $response = User::where([
                        'email' => $request->input('email'),
                        'password' => $request->input('password'),
                    ])->where('email_verified_at', '!=', null)->first();

        if($response) {
            $request ->session()->put('name', $response->name);
            //session([name], $response->name);
            return redirect('dashboard')->with('success', 'Login berhasil!');
            
        } else {
            return back()->with('error', 'Email atau password salah.')->withInput();
        }
    }

}   
