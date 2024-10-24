<?php

namespace App\Http\Controllers;

use App\Models\FormUser;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    public function index() {
        $data = FormUser::all();
        
        return view('user.index', ['title' => 'Data User', 'data'=> $data,]);
    }
    
    public function formuser_page() {
        return view('user.form', ['title' => 'Form Tambah User']);
    }

    public function manageuser_page($id) {
        $mahasiswa = FormUser::findOrfail($id);
        return view('user.manage', ['title'=> 'Edit User', 'mahasiswa'=> $mahasiswa]);
    }

    
}


