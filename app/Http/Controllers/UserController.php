<?php

namespace App\Http\Controllers;

use App\Baskets;
use App\Discount;
use App\Library\ShowTable;
use App\Order;
use App\Product;
use App\m_image;
use App\Stuff;
use App\Users_address;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
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
        session(['discount_code' => "null"]);
        session(['discount' => "0"]);
        session(['discount_id'=>"1"]);

        return view('rapiden_layouts.user.Basket');
    }

    public function checkout()
    {
        $user_addresses=Auth::user()->addresses()->get();
        return view('rapiden_layouts.user.checkout',compact('user_addresses'));
    }

    public function add_address(Request $request)
    {
//        dd($request->all());
        $user_addresses=Auth::user()->addresses()->create(['name_family'=>$request->name_family,'mobile_number'=>$request->mobile_number,
            'phone_number'=>$request->phone_number,'province'=>$request->province,'city'=>$request->city,'address'=>$request->address,
            'postal_code'=>$request->postal_code,'email'=>$request->email,'country'=>'iran']);
        return redirect()->route('user-checkout');
    }

    public function payment(Request $request)
    {
//        dd($request->all());
        $address=Users_address::find($request->select_address);
        return view('rapiden_layouts.user.payment',compact('address'));
    }

    public function Getway_request(Request $request)
    {
//        dd($request->all());
        $discount_row=Discount::where('code','=',$request->discount_code)->first();
        if(!empty($discount_row)) {

            if (strcmp($discount_row->calc_mode, 'MAX') == 0) {
                $discount = ($discount_row->percent / 100) * Cart::total();
                if ($discount < $discount_row->value) $discount = $discount_row->value;
            }
            if (strcmp($discount_row->calc_mode, 'MIN') == 0) {
                $discount = ($discount_row->percent / 100) * Cart::total();
                if ($discount > $discount_row->value) $discount = $discount_row->value;
            }
        }else{
            $discount=0;
        }
        $address=Users_address::find($request->address_id);

        Cart::store(Auth::user()->name,\auth()->id());
        $basket=Auth::user()->baskets()->create(['content'=>Cart::content(),'discount_id'=>$request->discount_id,'total_discount'=>$discount]);
        $order=Auth::user()->orders()->create(['basket_id'=>$basket->id,'users_address_id'=>$address->id,
            'pay_method'=>'1']);
        foreach(Cart::content() as $row)
        {
            $stuffs=new Stuff();
            $stuffs->basket_id=$basket->id;
            $stuffs->product_id=$row->id;
            $stuffs->qty=$row->qty;
            $stuffs->price=$row->price;
            $stuffs->tax=$row->tax;
            $stuffs->total_price=$row->total;
            $stuffs->discount=0;
            $stuffs->discount_code=0;
            $stuffs->discount_description=" no discount ";
            $stuffs->save();
        }
        Cart::destroy();
        return redirect()->route('products');
//        dd($request->all());
//        try {
//
//            $gateway = \Gateway::ZARINPAL();
//            $gateway->setCallback(url('callback/from/bank'));
//            $gateway->price(1000)->ready();
//            $refId =  $gateway->refId();
//            $transID = $gateway->transactionId();
//
//            // Your code here
//
//            return $gateway->redirect();
//
//        } catch (Exception $e) {
//
//            echo $e->getMessage();
//        }
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

    public function delete_Cart_item($rowId)
    {
        Cart::remove($rowId);
        return redirect()->back();
    }

    public function CalcDiscount($code)
    {
        $discount=Discount::where('code','=',$code)->firstOrFail();
        dd($discount);
    }

    public function jquery_post(Request $request)
    {

        $showtable=new ShowTable();
        if (isset($request->request_name)) {
            $request_name = $request->request_name;
            switch ($request_name) {
                case "basket_update":
                    $this->validate(request(), [
                        'row_qty' => 'required|numeric|min:0',
                    ]);
                    Cart::update($request->row_id,$request->row_qty);
                    return $showtable->user_basket();
                case "basket_delete":
                    Cart::remove($request->rowId);
                    return $showtable->user_basket();
                case "calc_discount":
                    session(['discount_code' => $request->code]);
                    $discount_row=Discount::where('code','=',$request->code)->first();
                    if(!empty($discount_row)){

                        if(strcmp($discount_row->calc_mode,'MAX')==0) {
                            $discount = ($discount_row->percent / 100) * Cart::total();
                            if($discount<$discount_row->value)$discount=$discount_row->value;
                        }
                        if(strcmp($discount_row->calc_mode,'MIN')==0) {
                            $discount = ($discount_row->percent / 100) * Cart::total();
                            if($discount>$discount_row->value)$discount=$discount_row->value;
                        }
                        session(['discount' => $discount]);
                        session(['discount_id' => $discount_row->id]);
                    }
                    else{
                        $discount=0;
                        session(['discount' => $discount]);
                        session(['discount_id' => "1"]);
                    }

                    return $showtable->user_basket_discount($discount);
            }
        }

    }

}
