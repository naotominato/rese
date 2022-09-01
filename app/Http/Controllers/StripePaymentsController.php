<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;

class StripePaymentsController extends Controller
{
    public function stripe(Request $request)
    {
        Stripe::setApiKey(env('STRIPE_SECRET')); //シークレットキー

        Charge::create([
            'amount' => $request->pay,//支払い金額
            'currency' => 'jpy',
            'source' => request()->stripeToken,
        ]);
        return back();
    }

    // public function index()
    // {
    //     return view('index');
    // }

    // public function stripe(Request $request)
    // {
    //     try {
    //         Stripe::setApiKey(env('STRIPE_SECRET'));

    //         $customer = Customer::create(array(
    //             'email' => Auth::user()->email,
    //             'source' => $request->stripeToken
    //         ));

    //         $charge = Charge::create(array(
    //             'customer' => $customer->id,
    //             'amount' => $request->pay,
    //             'currency' => 'jpy'
    //         ));

    //         return redirect()->route('complete');
    //     } catch (Exception $e) {
    //         return $e->getMessage();
    //     }
    // }

    // public function complete()
    // {
    //     return view('complete');
    // }
}

