<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Customer;
use Stripe\Charge;
use Illuminate\Support\Facades\Auth;

class StripeController extends Controller
{
    public function stripe(Request $request)
    {
        try {
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $customer = Customer::create(array(
                'name' => "[".$request->shop_name."(".$request->shop_id.")]".Auth::user()->name."(id:".Auth::id().")",
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
        } catch (\Stripe\Exception\CardException $e) {
            $result = 2;
            $error =  $e->getError()->message;

            // APIへのリクエストが早く多い
        } catch (\Stripe\Exception\RateLimitException $e) {
            $result = 3;
            $error =  $e->getError()->message;

            // パラメータ無効
        } catch (\Stripe\Exception\InvalidRequestException $e) {
            $result = 4;
            $error =  $e->getError()->message;

            // Stripe APIの認証に失敗
        } catch (\Stripe\Exception\AuthenticationException $e) {
            $result = 5;
            $error =  $e->getError()->message;

            // Stripe　ネットワークコミュニケーション失敗
        } catch (\Stripe\Exception\ApiConnectionException $e) {
            $result = 6;
            $error =  $e->getError()->message;

            // 一般的エラー
        } catch (\Stripe\Exception\ApiErrorException $e) {
            $result = 7;
            $error =  $e->getError()->message;

            // Stripeと無関係エラー
        } catch (Exception $e) {
            $result = 8;
            $error =  $e->getError()->message;
        }

        if ($result == 1) {
            return redirect()->route('paid')->with('message', 'お支払いが完了しました。ありがとうございました。');
        } elseif ($result == 2) {
            return redirect()->route('paid')->with('message', 'ご入力のカードでは、お支払いができませんでした。再度お試しいただくか、他のカードでお試しください。');
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

