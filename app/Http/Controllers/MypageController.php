<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;

class MypageController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $reserves = Reserve::where('user_id', Auth::id())->get();
        $favorites = Favorite::where('user_id', Auth::id())->get();

        return view('users.mypage', compact('user', 'reserves', 'favorites'));
    }

}
