<?php

namespace App\Http\Controllers;

use App\Basket;
use App\Order;
use App\Users_address;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        $orders=Order::paginate(10);
        return view('Admin.orders.oreders',compact('orders'));
    }

    public function search_orders(Request $request)
    {
//        dd($request->all());
        if(strcmp($request->user_name,'*')!=0) {
            $family = $request->user_name;
            $orders = Order::wherehas('info_user', function ($q) use ($family) {
                $q->where('family', 'LIKE', "%$family%");
            })->paginate(10);
        }elseif ($request->order_id!=0){
//            dd($request->order_id);
            $orders=Order::where('id',$request->order_id)->paginate(10);
        }else{
            $orders=Order::paginate(10);
        }
        return view('Admin.orders.oreders',compact('orders'));
    }

    public function disapprove_orders()
    {

        $orders=Order::wherehas('baskets',function($q){
            $q->where('status','=',0);
        })->paginate(10);
        return view('Admin.orders.disapprove_orders',compact('orders'));
    }

    public function approve_orders()
    {

        $orders=Order::wherehas('baskets',function($q){
            $q->where('status','=',2);
        })->paginate(10);
        return view('Admin.orders.approve_orders',compact('orders'));
    }

    public function edit(Request $request)
    {
        Users_address::where('id',$request->address_id)->update([
            'name_family'=>$request->name_family,
            'mobile_number'=>$request->mobile_number,
            'address'=>$request->address
            ]);

        Order::where('users_address_id',$request->address_id)->update([
            'address'=>'آدرس : '.$request->address.' تحویل گیرنده :  '.$request->name_family.' شماره تلفن : '.$request->mobile_number,
        ]);

        $s=$request->address;
        return $s;
    }


    public function approve_basket(Request $request)
    {
        Basket::where('id',$request->basket_id)->update([
            'status'=>'2'
        ]);

        $s='approve';
        return $s;
    }

    public function disapprove_basket(Request $request)
    {
        Basket::where('id',$request->basket_id)->update([
            'status'=>'0'
        ]);

        $s='disapprove';
        return $s;
    }
}
