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
use Illuminate\Support\Facades\Auth;

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
            return redirect()->route('managerpage');
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

    // public function shopCreate(ShopRegisterRequest $request) //店舗 新規作成用　バリデーション含めると思う
    // {
    //     $shop_id = $request->input('shop_id');
    //     //Authで店舗代表者とshop_idを一致させる
    //     $shop = $request->only([
    //         'area_id',
    //         'genre_id',
    //         'detail',
    //         'image_url',
    //     ]);

    //     //セキュリティ性を上げるため、一度、managerログイン者と照合している。
    //     $manager = Manager::where('id', Auth::id())->where('shop_id', $shop_id)->first();
    //     Shop::where('id', $manager->shop_id)->update($shop);
    //     return redirect()->route('managerpage');
    // }

    public function shopCreate(ShopRegisterRequest $request) //店舗 新規作成用　バリデーション含めると思う
    {
        //ファイルをストレージに保存処理
        $directory = 'shop_image';
        $file_name = $request->file('shop_image')->getClientOriginalName();
        $request->file('shop_image')->storeAs('public/' . $directory, $file_name);
        $image_url = 'storage/' . $directory . '/' . $file_name;

        //Authで店舗代表者とshop_idを一致させる
        $shop_id = $request->input('shop_id');
        
        //セキュリティ性を上げるため、一度、managerログイン者と照合している。
        $manager = Manager::where('id', Auth::id())->where('shop_id', $shop_id)->first();
        Shop::where('id', $manager->shop_id)->update([
            'area_id' => $request->area_id,
            'genre_id' => $request->genre_id,
            'detail' => $request->detail,
            'image_url' => $image_url,
        ]);
        return redirect()->route('managerpage');
    }

    // public function shopUpdata(ShopUpdateRequest $request) //店舗情報 更新用　バリデーション含めると思う
    // {
    //     $id = $request->input('id');
    //     $name = $request->input('name');
    //     $area = $request->input('area_id');
    //     $genre = $request->input('genre_id');
    //     $detail = $request->input('detail');
    //     $image_url = $request->input('image_url');

    //     Shop::where('id', $id)->update([
    //         'id' => $id,
    //         'name' => $name,
    //         'area' => $area,
    //         'genre' => $genre,
    //         'detail' => $detail,
    //         'image_url' => $image_url
    //     ]);
    //     return redirect()->route('managerpage');
    // }

    //自分の店舗の予約確認一覧　日時順
    public function reserved()
    {
        $manager = Manager::where('id', Auth::id())->first();
        $shop = Shop::where('id', $manager->shop_id)->first();
        $reserves = Reserve::where('shop_id', $shop->id)->orderBy('start', 'asc')->get();

        return view('managers.manager_reserved', compact('manager', 'reserves'));
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
}
