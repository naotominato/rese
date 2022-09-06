<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ReserveRequest;
use App\Http\Requests\ReserveUpdateRequest;
use App\Models\Reserve;
use Illuminate\Support\Facades\Auth;

class ReserveController extends Controller
{
    public function reserve(ReserveRequest $request) 
    {
        $date = $request->input('date');
        $time = $request->input('time');
        $datetime = $date . ' ' . $time;
        
        $reserve = new Reserve();
        $reserve->fill([
            'start' => $datetime,
            'user_id' => Auth::id(),
        ]);
        $reserve->fill($request->only([
            'shop_id',
            'number',
        ]));
        $reserve->save();
        return view('users.reserved');
    }

    //１つ前
    //idにもかかる新たなバリデーション
    public function update(ReserveUpdateRequest $request) //更新用
    {
        $reserve_id = $request->reserve_id;
        $shop_id = $request->shop_id;
        $number = $request->number;

        $date = $request->date;
        $time = $request->time;
        $datetime = $date . ' ' . $time;

        //不正を防ぐために条件を多めに設定
        Reserve::where('id', $reserve_id)->where('user_id', Auth::id())->where('shop_id', $shop_id)->update([
            'start' => $datetime,
            'number' => $number,
        ]);

        $reserved = Reserve::where('id', $reserve_id)->where('user_id', Auth::id())->where('shop_id', $shop_id)->first();
        $shop = $reserved->shop->name;
        $date = $reserved->start->format('Y年m月d日');
        $time = $reserved->start->format('H:i');
        $number = $reserved->number;

        return response()->json([
            // 'shop' => $shop,
            'date' => $date,
            'time' => $time,
            'number' => $number,
            ]);
    }

    //idにもかかる新たなバリデーション
    // public function update(ReserveUpdateRequest $request) //更新用
    // {
    //     $form = $request->form;
    //     $reserve_id = $form->reserve_id;
    //     $shop_id = $form->shop_id;
    //     $number = $form->number;

    //     $date = $form->date;
    //     $time = $form->time;
    //     $datetime = $date . ' ' . $time;

    //     //不正を防ぐために条件を多めに設定
    //     Reserve::where('id', $reserve_id)->where('user_id', Auth::id())->where('shop_id', $shop_id)->update([
    //         'start' => $datetime,
    //         'number' => $number,
    //     ]);

    //     return response()->json();
    // }

    // オリジナル
                 //idにもかかる新たなバリデーション
    // public function update(ReserveUpdateRequest $request) //更新用
    // {
    //     $reserve_id = $request->input('reserve_id');
    //     $shop_id = $request->input('shop_id');
    //     $number = $request->input('number');

    //     $date = $request->input('date');
    //     $time = $request->input('time');
    //     $datetime = $date . ' ' . $time;

    //     //不正を防ぐために条件を多めに設定
    //     Reserve::where('id', $reserve_id)->where('user_id', Auth::id())->where('shop_id', $shop_id)->update([
    //         'start' => $datetime,
    //         'number' => $number,
    //     ]);

    //     return back();
    // }
    

    public function cancel($id) 
    {
        Reserve::find($id)->delete();
        return back();
    }
                        // ↓ 引数を考え中
    public function show($id) //店舗ごとに予約参照
    {
        $reserve_data = Reserve::where('shop_id', $id)->get();
        return view('', compact('reserve_data'));
    }
}
