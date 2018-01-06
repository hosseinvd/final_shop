<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larabookir\Gateway\Gateway;

class UserController extends Controller
{
    public function profile()
    {
        return view('user.profile');
    }
    public function basket()
    {
        Cart::store(Auth::user()->name,\auth()->id());

        return view('user.Basket');
    }

    public function Getway_request(Request $request)
    {
        dd($request->all());
        try {

            $gateway = \Gateway::ZARINPAL();
            $gateway->setCallback(url('callback/from/bank'));
            $gateway->price(1000)->ready();
            $refId =  $gateway->refId();
            $transID = $gateway->transactionId();

            // Your code here

            return $gateway->redirect();

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

    public function Getway_back()
    {
        try {

            $gateway = \Gateway::verify();
            $trackingCode = $gateway->trackingCode();
            $refId = $gateway->refId();
            $cardNumber = $gateway->cardNumber();

            // عملیات خرید با موفقیت انجام شده است
            // در اینجا کالا درخواستی را به کاربر ارائه میکنم


        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

}
