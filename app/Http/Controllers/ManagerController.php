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
use App\Models\User;
use Illuminate\Support\Facades\Auth;
//メール送信用
use Illuminate\Support\Facades\Mail;
use App\Mail\ManagerMail;
use Carbon\Carbon;

class ManagerController extends Controller
{
    public function manager()
    {
        return view('managers.manager_login');
    }

public function managerLogin(AuthRequest $request)
    {
        
        $manager = $request->only(['email', 'password']);
        if (Auth::guard('manager')->attempt($manager)) {
            return redirect()->route('managerreserved');
        } else {
            $user_none = "ログイン情報が一致しません。";
            return view('managers.manager_login', compact('user_none'));
        }
    }

    public function managerPage()
    {
        $manager = Manager::where('id', Auth::id())->first();

        $areas = Area::all();
        $genres = Genre::all();
        $shop_area = "";
        $shop_genre = "";
        $shop_name = "";
        $shop = Shop::where('id', $manager->shop_id)->first();

        $reserves = Reserve::where('shop_id', $shop->id)->get();

        return view('managers.manager_page', compact('manager', 'areas', 'genres', 'shop_area', 'shop_genre', 'shop', 'reserves'));
    }

    public function managerLogout(Request $request)
    {
        Auth::guard('manager')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        // 二重送信対策

        return redirect()->route('manager');
    }

    public function shopCreate(ShopRegisterRequest $request) //店舗 新規作成用　バリデーション含めると思う
    {
        //Authで店舗代表者とshop_idを一致させる
        $shop_id = $request->input('shop_id');

        //セキュリティ性を上げるため、一度、managerログイン者と照合。&&　else image_urlで使用。
        $manager = Manager::where('id', Auth::id())->where('shop_id', $shop_id)->first();

        if ($request->file('shop_image')) {
        //ファイルをストレージに保存処理
        $directory = 'shop_image';
        // $file_name = $request->file('shop_image')->getClientOriginalName();
        $request->file('shop_image')->storeAs('public/' . $directory, $manager->shop->name . $manager->shop->id . '.png');
        $image_url = 'storage/' . $directory . '/' . $manager->shop->name . $manager->shop->id . '.png';
        } else {
            $manager_shop = Shop::where('id', $manager->shop_id)->first();
            $image_url = $manager_shop->image_url;
        //     //fileがなかったら、Shopモデルから取得
        }

        Shop::where('id', $manager->shop_id)->update([
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'detail' => $request->detail,
            'image_url' => $image_url,
        ]);
        return redirect()->route('managerpage');
    }

    //自分の店舗の予約確認一覧　日時順
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

    //file用バリデーション作成予定
    public function upload(Request $request)
    {
        $directory = 'image_file';

        $file_name = $request->file('image')->getClientOriginalName();

        $request->file('image')->store('public/' . $directory, $file_name);

        $shop = new Shop();
        $shop->image_url = 'storage/' . $directory . '/' . $file_name;
        $shop->save();
        
        return back();
    }

    //メール送信機能（お気に入り済みの方へ）
    public function sent()
    {
        $manager = Manager::where('id', Auth::id())->first();
        $favorites = Favorite::where('shop_id', $manager->shop_id)->get();

        return view('managers.sentmail', compact('manager', 'favorites'));
    }

    public function send(Request $request)
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
        // $send = "送信完了しました！";
        return redirect()->route('completion');
    }

    public function completion()
    {
        return view('managers.completion');
    }

    //QRcontroller作成　検討中
    //予約idだけでも照合できるが、より照合性を高めた！
    public function reservedQr($reserved_id, $user_id, $shop_id)
    {
        //自店舗との照合
        $manager = Manager::where('shop_id', $shop_id)->first();
        //予約情報の有無を照合
        $reserved = Reserve::where('id', $reserved_id)->where('user_id', $user_id)->where('shop_id', $shop_id)->first();
        if ($manager && $reserved) {
            return view('managers.qr', compact('reserved'));
        } else {
            $different = "当店の予約情報と一致しません。";
            return view('managers.qr', compact('different'));
        }

    }
}
