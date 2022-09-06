<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function stripe1(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET')); //シークレットキー

        Charge::create([
            'amount' => $request->pay,//支払い金額
            'currency' => 'jpy',
            'source' => request()->stripeToken,
        ]);
        return back();
    }

    public function stripe(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'name' => "[".$request->shop_name."(".$request->shop_id.")]".Auth::user()->name."(id:".Auth::id().")",
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));

            $charge = Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1000,
                'currency' => 'jpy'
            ));

            return redirect()->route('paid');
        } catch (Exception $e) {
            return $e->getMessage();
            //失敗時のリダイレクトを設定する？
        }
    }


    public function paid()
    {
        return view('users.paid');
    }
}

