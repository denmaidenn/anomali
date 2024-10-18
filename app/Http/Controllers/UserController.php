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
    
    public function formuser() {
        return view('user.form', ['title' => 'Form Tambah User']);
    }

    public function edituser($id) {

        $user = User::find($id);

        return view('user.edit', compact('user'), ['title'=> 'Edit User']);
    }

    public function update(Request $request, $id) {
        $request->validate([ 
            'name'=> 'required',
            'email'=> 'required|email',
            'prodi'=> 'required',
            'kelas'=> 'required',
            'jenis_kelamin'=> 'required',
        ]);

        $user = User::find($id);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->prodi = $request->prodi;
        $user->kelas = $request->kelas;
        $user->jenis_kelamin = $request->jenis_kelamin;
        $user->save();

        return redirect()->route('user.index')->with('success','User Updated successfully.');
    }

    
}


