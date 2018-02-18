<?php

namespace App\Http\Controllers;

use App\Cheque;
use App\Payment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\jDateTime;

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

    public function ShowPage(Payment $payment)
    {
        return view('Admin.payments.ShowPayment',compact('payment'));
    }


    public function a_update_payment(Request $request)
    {
//        dd($request->all());


        $s_date = explode('-', $request->due_date);
        $s_date_m=jDateTime::toGregorian($s_date[0], $s_date[1], $s_date[2]); // [2016, 5, 7]
        $s_date_m=Carbon::createFromDate($s_date_m[0],$s_date_m[1],$s_date_m[2]);

        Payment::find($request->payment_id)->update(['price'=>$request->price]);
        Cheque::find($request->cheque_id)->update(['serial_number'=>$request->serial_number,'pay_to'=>$request->pay_to,'price'=>$request->price,
            'mobile_number'=>$request->mobile_number,'bank_address'=>$request->bank_address,'bank'=>$request->bank,'due_date'=>$s_date_m,
            'description'=>$request->description,'imagePath'=>'']);

        return redirect()->route('a_show_payment',$request->payment_id);
    }

}
