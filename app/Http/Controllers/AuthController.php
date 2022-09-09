<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\EmailVerificationRequest;

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

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('index');
    }

    public function mailVerify()
    {
        return view('users.auth_send');
    }

    public function mailResend(Request $request)
    {
        $request->user()->sendEmailVerificationNotification();
        return view('users.auth_resend');
    }

    public function mailLink(EmailVerificationRequest $request)
    {
        $request->fulfill();
        return redirect()->route('mail.auth');
    }


    public function mailAuth()
    {
        return view('users.auth');
    }
}

