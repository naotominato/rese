<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Shop;
use App\Models\Area;
use App\Models\Genre;

class ShopController extends Controller
{
    public function index()
    {
        $shops = Shop::all();
        $areas = Area::all();
        $genres = Genre::all();
        $shop_area = "";
        $shop_genre = "";
        $shop_name = "";

        return view('users.index', compact('shops', 'areas', 'genres', 'shop_area', 'shop_genre', 'shop_name'));
    }

    public function search(Request $request)
    {
        $shop_area = $request->input('area');
        $shop_genre = $request->input('genre');
        $shop_name = $request->input('name');
        $query = Shop::query();

        if (!empty($shop_area)) {
            $query->where('area_id', $shop_area);
        }

        if (!empty($shop_genre)) {
            $query->where('genre_id', $shop_genre);
        }

        if (!empty($shop_name)) {
            $query->where('name', 'LIKE BINARY', "%{$shop_name}%");
        }

        $shops = $query->get();
        $areas = Area::all();
        $genres = Genre::all();

        return view('users.index', compact('shops', 'areas', 'genres', 'shop_area', 'shop_genre', 'shop_name'));
    }

    public function detail($id)
    {
        $shop = Shop::find($id);
        if (!session()->has('url.intended')) {
            session(['url.intended' => url()->previous()]);
        }
        return view('users.detail', compact('shop'));
    }

    public function back()
    {
        return redirect()->intended();
    }
}
