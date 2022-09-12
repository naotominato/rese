<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;
use Exception;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'name' => "[".$request->shop_name."(".$request->shop_id.")]".Auth::user()->name."(".Auth::id().")",
                'email' => $request->stripeEmail,
                'source' => $request->stripeToken
            ));
            Charge::create(array(
                'customer' => $customer->id,
                'amount' => 1000,
                'currency' => 'jpy'
            ));
            $result = 1;

           // カード情報不備などで支払いを拒否
        } catch (\Stripe\Exception\CardException) {
            $result = 2;

            // APIへのリクエストが早く多い
        } catch (\Stripe\Exception\RateLimitException) {
            $result = 3;

            // パラメータ無効
        } catch (\Stripe\Exception\InvalidRequestException) {
            $result = 4;

            // Stripe APIの認証に失敗
        } catch (\Stripe\Exception\AuthenticationException) {
            $result = 5;

            // Stripe　ネットワークコミュニケーション失敗
        } catch (\Stripe\Exception\ApiConnectionException) {
            $result = 6;

            // 一般的エラー
        } catch (\Stripe\Exception\ApiErrorException) {
            $result = 7;

            // Stripeと無関係なエラー
        } catch (Exception) {
            $result = 8;
        }

        if ($result == 1) {
            return redirect()->route('paid')->with('message', 'お支払いが完了しました。');
        } elseif ($result == 2) {
            return redirect()->route('paid')->with('message', 'このカードでは、お支払いができませんでした。');
        } elseif ($result == 3) {
            return redirect()->route('paid')->with('message', 'APIエラーです。');
        } elseif ($result == 4) {
            return redirect()->route('paid')->with('message', 'パラメータが無効です。');
        } elseif ($result == 5) {
            return redirect()->route('paid')->with('message', '認証に失敗しました。');
        } elseif ($result == 6) {
            return redirect()->route('paid')->with('message', '通信エラーです。');
        } elseif ($result == 7) {
            return redirect()->route('paid')->with('message', 'エラーが起こりました。');
        } elseif ($result == 8) {
            return redirect()->route('paid')->with('message', 'エラーが起こりました。');
        }
    }

    public function paid()
    {
        return view('users.paid');
    }
}

