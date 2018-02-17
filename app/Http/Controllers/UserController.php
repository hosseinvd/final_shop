<?php

namespace App\Http\Controllers;

use App\BankAccount;
use App\Basket;
use App\Cheque;
use App\Discount;
use App\Info_user;
use App\Library\ShowTable;
use App\Order;
use App\Product;
use App\m_image;
use App\Reseller;
use App\Stuff;
use App\Users_address;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;
use Larabookir\Gateway\Gateway;
use App\Category;
use App\Http\Requests\StoreProduct;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Morilog\Jalali\jDateTime;
use SebastianBergmann\Environment\Console;

class UserController extends AdminController
{

    public function profile()
    {
        $user_info=Auth::user()->info_user()->first();
        $user_discounts=Auth::user()->discount()->get();
//        dd($user_discount);

        return view('rapiden_layouts.user.profile',compact('user_info','user_discounts'));
    }
    public function enter_user_info()
    {
        $user_info=Auth::user()->info_user()->first();
        return view('rapiden_layouts.user.enter_user_info',compact('user_info'));
    }

    public function submit(Request $request)
    {
//        dd($request->all());
        $file = $request->file('images');
        $imagesUrl['images']['400']="no_img";
        if ($file) {
            $imagesUrl = $this->upload_profile_Images($file);
//            $imagesUrl['images']['900']
            $image_path=$imagesUrl['images']['400'];
        }else
        {
            $user_info=Auth::user()->info_user()->first();
            $image_path=$user_info->imagePath;
        }
        $s_date = explode('-', $request->birthday);
        $s_date_m=jDateTime::toGregorian($s_date[0], $s_date[1], $s_date[2]); // [2016, 5, 7]
        $s_date_m=Carbon::createFromDate($s_date_m[0],$s_date_m[1],$s_date_m[2]);

        $user_info=Auth::user()->info_user()->update([
            'name'=>$request->name,
            'family'=>$request->family,
            'national_code'=>$request->national_code,
            'phone_number'=>$request->phone_number,
            'mobile_number'=>$request->mobile_number,
            'country'=>$request->country,
            'province'=>$request->province,
            'city'=>$request->city,
            'address'=>$request->address,
            'postal_code'=>$request->postal_code,
            'user_email'=>$request->user_email,
            'birthday'=>$s_date_m,
            'imagePath'=>$image_path,
        ]);

        return redirect()->route('u_user-profile');
    }

    public function basket()
    {
        return view('rapiden_layouts.user.Basket');
    }

    public function refund_basket(Basket $basket)
    {
//        dd($basket->all());
       return view('rapiden_layouts.user.refund_basket',compact('basket'));
    }

    public function refund_stuffs(Request $request)
    {
//        dd($request->all());
        $parent_basket=Basket::find($request->basket_id);

        $basket=new Basket();
        $basket->children_id=0;
        $basket->user_id=Auth::user()->id;
        $basket->order_id=$parent_basket->order->id;
        $basket->content=$parent_basket->content;
        $basket->discount_id=$parent_basket->discount_id;
        $price=0;
        $total_discount=0;
        $paid=0;

        $basket->price=$price;
        $basket->total_discount=$total_discount;
        $basket->paid=$paid;
        $basket->save();

        $parent_basket=Basket::find($request->basket_id);
        $parent_basket->children_id=$basket->id;
        $parent_basket->save();

        for($x=0;$x<count($request->stuff_id);$x++)
        {
            $parent_stuff=Stuff::find($request->stuff_id[$x]);
            $refund_qty=$parent_stuff->qty-$request->stuff_qty[$x];
            if($refund_qty>0) {
                $m_stuffs = new Stuff();
                $m_stuffs->basket_id = $basket->id;
                $m_stuffs->product_id = $parent_stuff->product_id;
                $m_stuffs->qty = $refund_qty;
                $m_stuffs->price = $parent_stuff->price;
                $m_stuffs->tax = $parent_stuff->tax;
                $m_stuffs->total_price = ($parent_stuff->price - $parent_stuff->discount*$parent_stuff->price) * $refund_qty;
                $m_stuffs->discount = $parent_stuff->discount;
                $m_stuffs->discount_code = $parent_stuff->discount_code;
                $m_stuffs->discount_description = "refund stuff";
                $total_discount = $parent_stuff->discount;
                $price = $price + $parent_stuff->price * $refund_qty;
                $m_stuffs->save();
            }
        }
        $paid=$price-$price*$total_discount;

        $basket=Basket::find($basket->id);
        $basket->price=$price;
        $basket->total_discount=$total_discount*$price;
        $basket->paid=$paid;
        $basket->basket_type=1;
        $basket->save();

        return redirect()->route('user-orders');
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
            'postal_code'=>$request->postal_code,'email'=>$request->email,'country'=>'ایران']);
        return redirect()->route('user-checkout');
    }

    public function payment(Request $request)
    {
//        dd($request->all());
        $address=Users_address::find($request->select_address);
        return view('rapiden_layouts.user.payment',compact('address'));
    }

    public function orders()
    {
        $orders=Auth::user()->orders()->with('users_address','baskets')->get();
//        dd($orders->all());
        return view('rapiden_layouts.user.oreders',compact('orders'));
    }
    public function comments()
    {
        $comments=Auth::user()->comments()->get();
        return view('rapiden_layouts.user.comments',compact('comments'));
    }
    public function add_cheque(Request $request)
    {
//        dd($request->all());
        $s_date = explode('-', $request->due_date);
        $s_date_m=jDateTime::toGregorian($s_date[0], $s_date[1], $s_date[2]); // [2016, 5, 7]
        $s_date_m=Carbon::createFromDate($s_date_m[0],$s_date_m[1],$s_date_m[2]);

        $payment=Auth::user()->payments()->create(['basket_id'=>$request->basket_id,'pay_method'=>'2','state'=>'0','price'=>$request->price,'transaction_date'=>Carbon::now()]);

        $cheque=Auth::user()->cheques()->create(['payment_id'=>$payment->id,'serial_number'=>$request->serial_number,'pay_to'=>$request->pay_to,'price'=>$request->price,
            'mobile_number'=>$request->mobile_number,'bank_address'=>$request->bank_address,'bank'=>$request->bank,'due_date'=>$s_date_m,
            'basket_id'=>$request->basket_id,'description'=>$request->description,'imagePath'=>'']);
        return redirect()->route('user_basket_cheques',$request->basket_id);
    }
    public function cheques($basket_id)
    {
        $pay=Basket::find($basket_id)->paid;
        $payments=Basket::find($basket_id)->payments;
//        dd($payments);
        return view('rapiden_layouts.user.cheque',compact('payments','basket_id','pay'));
    }
    public function add_pay(Request $request)
    {
        $this->validate(request(), [
            'price' => 'required|numeric|min:0',
        ]);
        $this->go_to_bank($request->price,$request->basket_id);
        return redirect()->route('user_basket_cheques',$request->basket_id);

    }
    public function bank_account()
    {
        $bank_interactions=Auth::user()->bankaccounts()->with('payer')->get();
        return view('rapiden_layouts.user.bank_account',compact('bank_interactions'));
    }
    public function addToCart(Product $product)
    {
        Cart::add($product->id, $product->title, 1, $product->price);
        return back();
    }
    public function category_html()
    {
        return view('category');
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
            $product=Product::find($request->product_id[$i]);
            $pr=($product->inventory-$request->row_qty[$i]);
            if($pr>=0) {
                Cart::update($request->row_id[$i], $request->row_qty[$i]);
            }
        }
        return redirect()->route('user-basket');
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
                    $product=Product::find($request->product_id);
                    $pr=($product->inventory-$request->row_qty);
                    if($pr>=0){
                        Cart::update($request->row_id,$request->row_qty);
                        $s=$showtable->user_basket();
                    }else{
//                        $row_qty_temp=Cart::get($request->row_id)->qty;
//                        Cart::update($request->row_id,$request->row_qty);
                        $s=$showtable->user_basket();
//                        Cart::update($request->row_id,$row_qty_temp);
                        $s=$s."<h3>موجودی ".$product->title."کافی نیست</h3>";
                    }
                    return $s;
                case "basket_delete":
                    Cart::remove($request->rowId);
                    return $showtable->user_basket();
                case "calc_discount":
                    session(['discount_code' => $request->code]);
                    $discount_row=Discount::where('code','=',$request->code)->first();
                    Log::info('discount'.$discount_row);

                    if(!empty($discount_row)){
                        $discount=0.00000;
//                        $discount_row->decrement('numbers');
                        if(strcmp($discount_row->calc_mode,'MAX')==0) {
                            $discount = ($discount_row->percent / 100) * Cart::subtotal();
                            if($discount<$discount_row->value){
                                $discount=$discount_row->value;
                            }
                        }
                        if(strcmp($discount_row->calc_mode,'MIN')==0) {
//                            $x=str_replace(",", "", Cart::subtotal());
//                            Log::info('discount'.$x);

                            $discount = (($discount_row->percent / 100) * (Cart::subtotal()));
                            if($discount>$discount_row->value){
                                $discount=$discount_row->value;
                            }
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
    public function calc_money($request)
    {
        // calculate amount of discount
        $discount_row=Discount::where('code','=',$request->discount_code)->first();

        if(!empty($discount_row)) {
            if($discount_row->numbers>0) {
                if (strcmp($discount_row->calc_mode, 'MAX') == 0) {
                    $discount = ($discount_row->percent / 100) * Cart::subtotal();
                    if ($discount < $discount_row->value) $discount = $discount_row->value;
                }
                if (strcmp($discount_row->calc_mode, 'MIN') == 0) {
                    $discount = ($discount_row->percent / 100) * Cart::subtotal();
                    if ($discount > $discount_row->value) $discount = $discount_row->value;
                }
                $discount_row->decrement('numbers');
            }
        }else{
            $discount=0;
        }

        // create order And Basket And Stuff
        $pay=Cart::total()-$discount;

        $discount_percent=$discount/Cart::subtotal();
        $address=Users_address::find($request->address_id);
        $info_user=Info_user::where('user_id',Auth::user()->id)->first();
        $order=Auth::user()->orders()->create([
            'users_address_id'=>$address->id,
            'info_user_id'=>$info_user->id,
            'address'=>$address->country.' - '.$address->province.' - '.$address->city.' - '.$address->address.' - کدپستی : '.$address->postal_code.' - گیرنده : '.$address->name_family.' شماره تلفن : '.$address->mobile_number,
            'pay_method'=>'1']);
        Cart::store(Auth::user()->name,\auth()->id());

        if($request->discount_id!=null){
            $discount_id=$request->discount_id;
        }else{
            $discount_id='1';
        }

        $basket=Auth::user()->baskets()->create([
            'order_id'=>$order->id,
            'content'=>Cart::content(),
            'discount_id'=>$discount_id,
            'price'=>Cart::subtotal(),
            'tax'=>Cart::tax(),
            'total_discount'=>$discount,
            'paid'=>$pay,
        ]);

        foreach(Cart::content() as $row)
        {
            $product=Product::find($row->id);
            $product->inventory=$product->inventory-$row->qty;
            $product->save();
            $stuffs=new Stuff();
            $stuffs->basket_id=$basket->id;
            $stuffs->product_id=$row->id;
            $stuffs->qty=$row->qty;
            $stuffs->price=$row->price;
            $stuffs->tax=$row->tax;
            $stuffs->total_price=$row->total;
            $stuffs->discount=$discount_percent;
            $stuffs->discount_code=$discount_id;
            $stuffs->discount_description=" no discount ";
            $stuffs->save();
        }
        $this->commission($basket->id,$request->discount_code);
//        session(['discount_code' => "null"]);
//        session(['discount' => "0"]);
//        session(['discount_id'=>"1"]);
//        Cart::destroy();
        $pay_info=['price'=>$pay,'basket_id'=>$basket->id];
        return $pay_info;
    }
    public function commission($basket_id,$discount_code){
        // pay commission to seller and reseller
        $discount_row=Discount::where('code','=',$discount_code)->first();
        if(!empty($discount_row)) {
            if(strcmp($discount_row->type,'reseller_Discount')==0)
            {
                if($discount_row->user_id==Auth::user()->id){
                    $type=1;
                }else{
                    $type=3;
                }
                $commission=$discount_row->commission/100*Cart::subtotal();
                $user_commission=$discount_row->user_id;
                $bank_account=BankAccount::create([
                    'money'=>$commission,
                    'user_id'=>$user_commission,
                    'payer_id'=>Auth::user()->id,
                    'pay_to_id'=>$user_commission,
                    'type'=>$type,
                    'commission_paid'=>0,
                    'basket_id'=>$basket_id,
                ]);

//                $reseller=Reseller::where('reseller_id','=',$user_commission)->first();
                $reseller=Info_user::where('user_id','=',$user_commission)->first();

                if(!empty($reseller)) {
                    $bank_account=BankAccount::create([
                        'money'=>-1*$commission * $reseller->commission / 100,
                        'user_id'=>$user_commission,
                        'payer_id'=>$user_commission,
                        'pay_to_id'=>$reseller->seller_id,
                        'type'=>4,
                        'commission_paid'=>1,
                        'basket_id'=>$basket_id,
                    ]);

                    $bank_account = BankAccount::create([
                        'money' => $commission * $reseller->commission / 100,
                        'user_id' => $reseller->seller_id,
                        'payer_id' => $user_commission,
                        'pay_to_id'=>$reseller->seller_id,
                        'type' => 3,
                        'commission_paid' => 0,
                        'basket_id' => $basket_id,
                    ]);
                }

            }
        }

    }
    public function user_pay(Request $request)
    {
        $pay_info=$this->calc_money($request);
        $pay_method = $request->pay_method;
        switch ($pay_method) {
            case "cash":
                $this->go_to_bank($pay_info['price'],$pay_info['basket_id']);
                return redirect()->route('user-orders');
            case "credit":
                return redirect()->route('user_basket_cheques',$pay_info['basket_id']);
        }
    }

    public function go_to_bank($price,$basket_id)
    {
//        $this->Getway_request($price);
        $payment=Auth::user()->payments()->create(['basket_id'=>$basket_id,'pay_method'=>'1','state'=>'1','price'=>$price,'sender_ac_number'=>'1235543',
            'ref_id'=>'1','transaction_date'=>Carbon::now()]);
    }

    public function Getway_request($price)
    {
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

            //        return redirect()->route('user-orders');
            // عملیات خرید با موفقیت انجام شده است
            // در اینجا کالا درخواستی را به کاربر ارائه میکنم

        } catch (Exception $e) {

            echo $e->getMessage();
        }
    }

}
