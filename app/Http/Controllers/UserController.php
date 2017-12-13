<?php

namespace App\Http\Controllers;

use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
    //
}
