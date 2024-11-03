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
    
    public function create() {
        return view('user.create', ['title' => 'Form Tambah User']);
    }

    public function edit($id) {
        $formUser = FormUser::findOrfail($id);
        return view('user.manage', ['title'=> 'Edit User', 'formUser'=> $formUser]);
    }

    
}


