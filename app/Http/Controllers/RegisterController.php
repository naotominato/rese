<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class RegisterController extends Controller
{
    public function register()
    {
        return view('users.register');
    }

    public function create(RegisterRequest $request)
    {
        $name = $request->name;
        $email = $request->email;
        $password = $request->password;
        User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        return redirect()->route('thanks');
    }

    public function thanks()
    {
        return view('users.created');
    }
}