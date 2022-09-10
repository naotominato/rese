<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ShopRegisterRequest;
use App\Models\Shop;
use App\Models\Manager;
use App\Models\Area;
use App\Models\Genre;
use App\Models\Reserve;
use App\Models\Favorite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\ManagerMail;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function manager()
    {
        return view('managers.manager_login');
    }

public function login(AuthRequest $request)
    {
        $manager = $request->only(['email', 'password']);
        if (Auth::guard('manager')->attempt($manager)) {
            return redirect()->route('manager.reserved');
        } else {
            $user_none = "ログイン情報が一致しません。";
            return view('managers.manager_login', compact('user_none'));
        }
    }

    public function logout(Request $request)
    {
        Auth::guard('manager')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('manager');
    }

    public function reserved()
    {
        $manager = Manager::where('id', Auth::id())->first();
        $shop = Shop::where('id', $manager->shop_id)->first();

        $today = Carbon::today();
        $todays = Reserve::where('shop_id', $shop->id)->whereDate('start', '=', $today)->orderBy('start', 'asc')->get();

        $now = Carbon::now();
        $reserves = Reserve::where('shop_id', $shop->id)->where('start', '>=', $now)->orderBy('start', 'asc')->get();

        $pasts =
            Reserve::where('shop_id', $shop->id)->where('start', '<', $now)->orderBy('start', 'desc')->get();

        return view('managers.manager_reserved', compact('manager', 'todays', 'reserves', 'pasts'));
    }

    public function managerShop()
    {
        $manager = Manager::where('id', Auth::id())->first();
        $areas = Area::all();
        $genres = Genre::all();
        $shop_area = "";
        $shop_genre = "";
        $shop_name = "";
        $shop = Shop::where('id', $manager->shop_id)->first();

        return view('managers.manager_shop', compact('manager', 'areas', 'genres', 'shop_area', 'shop_genre', 'shop'));
    }

    public function shopCreate(ShopRegisterRequest $request)
    {
        $shop_id = $request->input('shop_id');
        $manager = Manager::where('id', Auth::id())->where('shop_id', $shop_id)->first();

        if ($request->file('shop_image')) {
        $directory = 'shop_image';
        $request->file('shop_image')->storeAs('public/' . $directory, $manager->shop->name . $manager->shop->id . '.png');
        $image_url = 'storage/' . $directory . '/' . $manager->shop->name . $manager->shop->id . '.png';
        } else {
            $manager_shop = Shop::where('id', $manager->shop_id)->first();
            $image_url = $manager_shop->image_url;
        }

        Shop::where('id', $manager->shop_id)->update([
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'detail' => $request->detail,
            'image_url' => $image_url,
        ]);
        return redirect()->route('manager.shop');
    }

    public function managerMail()
    {
        $manager = Manager::where('id', Auth::id())->first();
        $favorites = Favorite::where('shop_id', $manager->shop_id)->get();

        return view('managers.sentmail', compact('manager', 'favorites'));
    }

    public function mailSent(Request $request)
    {
        $manager = Manager::where('id', Auth::id())->first();
        $favorites = Favorite::where('shop_id', $manager->shop_id)->get();
        
        foreach ($favorites as $favorite) {
            $user_name = $favorite->user->name;
            $email = $favorite->user->email;
            $shop_name = $favorite->shop->name;
            $text = $request->input('text');
            Mail::send(new ManagerMail($user_name, $email, $shop_name, $text));
        }
        return redirect()->route('completion');
    }

    public function completion()
    {
        return view('managers.completion');
    }

    public function reservedQr($reserved_id, $user_id, $shop_id)
    {
        $manager = Manager::where('id', Auth::id())->where('shop_id', $shop_id)->first();
        $today = Carbon::today();
        $reserved = Reserve::where('id', $reserved_id)->where('user_id', $user_id)->where('shop_id', $shop_id)->whereDate('start', '=', $today)->first();

        if ($manager && $reserved) {
            return view('managers.qr', compact('reserved'));
        } else {
            $different = "当店の予約情報と一致しません。";
            return view('managers.qr', compact('different'));
        }
    }
}
