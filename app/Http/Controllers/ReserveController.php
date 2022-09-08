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

    public function update(ReserveUpdateRequest $request)
    {
        $reserve_id = $request->input('reserve_id');
        $shop_id = $request->input('shop_id');
        $number = $request->input('number');

        $date = $request->input('date');
        $time = $request->input('time');
        $datetime = $date . ' ' . $time;

        Reserve::where('id', $reserve_id)->where('user_id', Auth::id())->where('shop_id', $shop_id)->update([
            'start' => $datetime,
            'number' => $number,
        ]);
        return back();
    }
    
    public function cancel($id) 
    {
        Reserve::find($id)->delete();
        return back();
    }
}
