<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Http\Request;

class SignController extends Controller
{
    //

    public function index() {
        return view('sign.index');
    }
    
    // public function in(Request $request) {
    //     $response = User::where([
    //                     'email' => $request->input('email'),
    //                     'password' => $request->input('password'),
    //                 ])->where('email_verified_at', '!=', null)->first();

    //     if($response) {
    //         $request ->session()->put('name', $response->name);
    //         //session([name], $response->name);
    //         return redirect('dashboard')->with('success', 'Login berhasil!');
            
    //     } else {
    //         return back()->with('error', 'Email atau password salah.')->withInput();
    //     }
    // }

    public function in(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        $user = User::where('email', $request->input('email'))->first();

        if ($user && Hash::check($request->input('password'), $user->password)) {
            if ($user->email_verified_at) {
                Auth::login($user);  // Login the user
                return redirect('dashboard')->with('success', 'Login berhasil!');
            } else {
                return back()->with('error', 'Email belum diverifikasi.')->withInput();
            }
        } else {
            return back()->with('error', 'Email atau password salah.')->withInput();
        }
    }

    public function logout(Request $request) {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('success', 'Logout berhasil!');
    }

}   
