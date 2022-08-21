<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use App\Http\Requests\ShopNameRegisterRequest;
use App\Http\Requests\AuthRequest;
use App\Http\Requests\ManagerRegisterRequest;
use App\Models\Manager;
use App\Models\Shop;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;


class AdminController extends Controller
{
    public function admin()
    {
        return view('admin.adminlogin'); 
        //view名スネークケースに変更する
    }

        //controller名　アッパーキャメルにする
    public function adminLogin(AuthRequest $request)
    {
        
        $admin = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($admin)) {
            return redirect()->route('adminpage');
        } else {
            $user_none = "ログイン情報が一致しません。";
            return view('admin.adminlogin', compact('user_none'));
        }
    }

    public function shop()
    {
        $shops = Shop::all();
        return view('admin.admin_shop', compact('shops'));
    }

    public function shopCreate(ShopNameRegisterRequest $request)
    {
        $shop_name = $request->input('shop_name');
        Shop::create([
            'name' => $shop_name,
        ]);
        return redirect()->route('shoppage');
    }

    public function adminPage()
    {
        $managers = Manager::all();
        $shops = Shop::all();
        return view('admin.adminpage', compact('managers', 'shops'));
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        // 二重送信対策

        return redirect()->route('admin');
    }

    public function managerCreate(ManagerRegisterRequest $request)
    //バリデーション作成予定
    {
        $shop_id = $request->input('shop_id');
        //$shop_name = $request->input('shop_id');
        // $shop = Shop::create([
        //     'name' => $shop_name,
        // ]);
        $shop= Shop::where('id', $shop_id)->first();
        //$shop_id = $request->input('shop_id');
        $manager_name = $request->manager_name;
        $email = $request->email;
        $password = $request->password;
        Manager::create([
            'shop_id' => $shop->id,
            'name' => $manager_name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        return redirect()->route('adminpage');
    }
}
