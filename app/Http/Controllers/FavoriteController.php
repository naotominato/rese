<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Favorite;


class FavoriteController extends Controller
{
    public function change(Request $request)
    {
        $user_id = Auth::id();
        $shop_id = $request->shop_id;
        $favorited = Favorite::where('user_id', $user_id)->where('shop_id', $shop_id)->first();

        if (!$favorited) {
            $favorite = new Favorite;
            $favorite->shop_id = $shop_id;
            $favorite->user_id = $user_id;
            $favorite->save();
        } else {
            Favorite::where('user_id', $user_id)->where('shop_id', $shop_id)->delete();
        }
        return response()->json();
    }

    public function delete(Request $request)
    {
        $shop = $request->input('favorite');
        Favorite::where('user_id', Auth::id())->where('shop_id', $shop)->delete();

        return back();
    }
}
