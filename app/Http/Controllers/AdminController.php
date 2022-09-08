<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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
        return view('admin.admin_login'); 
    }

    public function adminLogin(AuthRequest $request)
    {
        $admin = $request->only(['email', 'password']);
        if (Auth::guard('admin')->attempt($admin)) {
            return redirect()->route('manager.list');
        } else {
            $user_none = "ログイン情報が一致しません。";
            return view('admin.adminlogin', compact('user_none'));
        }
    }

    public function shopList()
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
        return redirect()->route('shop.list')->with('message', '登録が反映されました。');
    }

    public function managerList()
    {
        $managers = Manager::all();
        $shops = Shop::all();
        return view('admin.admin_manager', compact('managers', 'shops'));
    }

    public function adminLogout(Request $request)
    {
        Auth::guard('admin')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('admin');
    }

    public function managerCreate(ManagerRegisterRequest $request)
    {
        $shop_id = $request->input('shop_id');
        $shop= Shop::where('id', $shop_id)->first();
        $manager_name = $request->manager_name;
        $email = $request->email;
        $password = $request->password;
        Manager::create([
            'shop_id' => $shop->id,
            'name' => $manager_name,
            'email' => $email,
            'password' => Hash::make($password),
        ]);
        return redirect()->route('manager.list')->with('message', '新しい店舗代表者が登録されました。');;
    }
}
