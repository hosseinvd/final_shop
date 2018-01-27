<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function orders()
    {
        $orders=Order::paginate(10);

        return view('Admin.orders.oreders',compact('orders'));
    }
}
