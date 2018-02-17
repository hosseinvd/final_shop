<?php

namespace App\Http\Controllers;

use App\Payment;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    public function approve_payment(Request $request)
    {
        Payment::where('id',$request->payment_id)->update([
            'state'=>'1'
        ]);

        $s='approve';
        return $s;
    }

    public function disapprove_payment(Request $request)
    {
        Payment::where('id',$request->payment_id)->update([
            'state'=>'0'
        ]);

        $s='disapprove';
        return $s;
    }

    public function ShowEditPage(Payment $payment)
    {

        return view('Admin.payments.EditPayment',compact('payment'));
    }


    public function a_Store_payment(Request $request)
    {
        $payment=Auth::user()->payments()->create(['basket_id'=>$request->basket_id,'pay_method'=>'2','state'=>'0','price'=>$request->price,'transaction_date'=>Carbon::now()]);
        $cheque=Auth::user()->cheques()->create(['payment_id'=>$payment->id,'serial_number'=>$request->serial_number,'pay_to'=>$request->pay_to,'price'=>$request->price,
            'mobile_number'=>$request->mobile_number,'bank_address'=>$request->bank_address,'bank'=>$request->bank,'due_date'=>$s_date_m,
            'basket_id'=>$request->basket_id,'description'=>$request->description,'imagePath'=>'']);
        return redirect()->route('a_orders');
    }

}
