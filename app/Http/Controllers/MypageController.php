<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reserve;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;


class MypageController extends Controller
{
    public function mypage()
    {
        $user = Auth::user();
        $reserves = Reserve::where('user_id', Auth::id())->get();
        $favorites = Favorite::where('user_id', Auth::id())->get();

        $now = new Carbon();
        $now = Carbon::now();

        // foreach ($reserves as $reserve) {
        //     if ($reserve->start->format('Y-m-d') < $now) {
        //         $pasts = $reserves->whereDate($reserve->start->format('Y-m-d'), '<', $now)->first();
        //     } elseif ($reserve->start->format('Y-m-d') >= $now) {
        //         $futures = $reserves->whereDate($reserve->start->format('Y-m-d'), '>=', $now)->first();
        //     }
        // }

        return view('users.mypage', compact('user', 'reserves', 'now', 'favorites'));
    }

    // public function qrcode($id)
    // {
    //     $reserved =
    //     Reserve::where('id', $id)->where('user_id', Auth::id())->first();

    //     return view('users.qrcode', compact('reserved'));
    // }

    //QRコード　mypage.blade.php用
    //<a href="{{ route('qrcode', ['reserved_id' => $reserve->id]) }}">QRcode</a>

}
