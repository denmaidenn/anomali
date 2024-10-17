<?php

// FormController.php
namespace App\Http\Controllers;

use App\Models\FormUser;
use Illuminate\Http\Request;

class FormController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate the request (optional but recommended)
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email',
            'prodi' => 'required|string',
            'kelas' => 'required|string',
            'jenis_kelamin' => 'required|string',
        ]);

        FormUser::create([
            'name'=> $validatedData['name'],
            'email'=> $validatedData['email'],
            'prodi'=> $validatedData['prodi'],
            'kelas' => $validatedData['kelas'],
            'jenis_kelamin' => $validatedData['jenis_kelamin'],

        ]);

        // Pass the submitted data to the view

        return redirect('/userpages');
    }
}

