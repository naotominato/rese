<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Auth\Events\Registered;

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
        $user = User::create([
            'name' => $name,
            'email' => $email,
            'password' => Hash::make($password)
        ]);
        event(new Registered($user));
        return redirect()->route('registered');
    }

    //ユーザー登録後、表示画面
    public function registered()
    {
        return view('emails.registered-send-email');
    }

    public function thanks()
    {
        return view('users.created');
    }
}