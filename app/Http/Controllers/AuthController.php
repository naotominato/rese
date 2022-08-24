<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function auth()
    {

        return view('users.login');
    }

    public function login(AuthRequest $request)
    {
        $user = $request->only(['email', 'password']);
        if (Auth::attempt($user)) {
            return redirect()->route('index');
        } else {
            $user_none = "ログイン情報が一致しません。";
                return view('users.login', compact('user_none'));
        }
    }

    //メール認証後の表示画面を検討中
    // public function __construct()
    // {
    //     $this->middleware('verified')->only('kari');
    // }

    // public function kari()
    // {
    //     return redirect()->route('index');
    // }

    public function mailAuth()
    {
        return view('emails.Auth');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        // 二重送信対策

        return redirect()->route('index');
    }
}

