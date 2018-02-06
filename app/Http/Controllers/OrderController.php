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

    public function edit(Request $request)
    {
        Users_address::where('id',$request->address_id)->update([
            'name_family'=>$request->name_family,
            'mobile_number'=>$request->mobile_number,
            'address'=>$request->address
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
