<?php

namespace App\Http\Controllers;

use App\Library\ShowTable;
use App\Product;
use App\m_image;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Larabookir\Gateway\Gateway;
use App\Category;
use App\Http\Requests\StoreProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class UserController extends Controller
{

    public function profile()
    {
        return view('user.profile');
    }
    public function basket()
    {
        Cart::store(Auth::user()->name,\auth()->id());
        return view('rapiden_layouts.user.Basket');
//        return view('user.Basket');

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

    public function addToCart(Product $product)
    {
        Cart::add($product->id, $product->title, 1, $product->price);

        return back();
    }

    public function addToCartWithNumber(Request $request)
    {
//        dd($request->all());
        $this->validate(request(), [
            'qty' => 'required|numeric|min:1',
        ]);
        $product=Product::find($request->id);
        Cart::add($product->id, $product->title, $request->qty, $product->price);
        return back();
    }

    public function update_full_basket(Request $request)
    {
        for ($i=0;$i<count($request->row_id);$i++){
            Cart::update($request->row_id[$i],$request->row_qty[$i]);
        }
        return redirect()->back();
    }

    public function updateCart(Request $request)
    {

        $this->validate(request(), [
            'row_qty' => 'required|numeric|min:0',
        ]);
        Cart::update($request->row_id,$request->row_qty);

        return redirect(route('user-basket'));
    }

    public function jquery_post(Request $request)
    {
        $this->validate(request(), [
            'row_qty' => 'required|numeric|min:0',
        ]);
        Cart::update($request->row_id,$request->row_qty);

        $showtable=new ShowTable();
        if (isset($request->request_name)) {
            $request_name = $request->request_name;
            switch ($request_name) {
                case "basket_update":
                    return $showtable->user_basket();

            }
        }

    }

}
