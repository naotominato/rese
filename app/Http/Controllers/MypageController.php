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

        $now = Carbon::now();
        //予約済み　直近の日付順
        $reserves = Reserve::where('user_id', Auth::id())->where('start', '>=', $now)->orderBy('start', 'asc')->get();

        //過去の予約　直近の日付順
        $pasts =
        Reserve::where('user_id', Auth::id())->where('start', '<', $now)->orderBy('start', 'desc')->get();

        $favorites = Favorite::where('user_id', Auth::id())->get();

        // $now = new Carbon();

        // foreach ($reserves as $reserve) {
        //     if ($reserve->start->format('Y-m-d') < $now) {
        //         $pasts = $reserves->whereDate($reserve->start->format('Y-m-d'), '<', $now)->first();
        //     } elseif ($reserve->start->format('Y-m-d') >= $now) {
        //         $futures = $reserves->whereDate($reserve->start->format('Y-m-d'), '>=', $now)->first();
        //     }
        // }

        return view('users.mypage', compact('user', 'reserves', 'now', 'pasts', 'favorites'));
    }

    //QRcontroller作成　検討中
    public function qrcode($id)
    {
        $reserved =
        Reserve::where('id', $id)->where('user_id', Auth::id())->first();

        return view('users.qrcode', compact('reserved'));
    }

    //QRコード　mypage.blade.php用
    //<a href="{{ route('qrcode', ['reserved_id' => $reserve->id]) }}">QRcode</a>
}
