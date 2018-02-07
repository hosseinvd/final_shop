<?php

namespace App\Http\Controllers;

use App\Discount;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Morilog\Jalali\jDateTime;

class DiscountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $discounts=Discount::orderBy('created_at', 'desc')->paginate(15);
        return view('Admin.discount.index',compact('discounts'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('Admin.discount.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $s_date = explode('-', $request->start_date);
        $s_date_m=jDateTime::toGregorian($s_date[0], $s_date[1], $s_date[2]); // [2016, 5, 7]
        $s_date_m=Carbon::createFromDate($s_date_m[0],$s_date_m[1],$s_date_m[2]);

        $e_date = explode('-', $request->end_date);
        $e_date_m=jDateTime::toGregorian($e_date[0], $e_date[1], $e_date[2]); // [2016, 5, 7]
        $e_date_m=Carbon::createFromDate($e_date_m[0],$e_date_m[1],$e_date_m[2]);
        //dd($request->all());
        $discount=Discount::create([
           'code'=>$request->code,
            'commission'=>$request->commission,
            'type'=>$request->type,
            'calc_mode'=>$request->calc_mode,
            'percent'=>$request->percent,
            'value'=>$request->value,
            'numbers'=>$request->numbers,
            'user_id'=>$request->user_id,
            'start_date'=>$s_date_m,
            'end_date'=>$e_date_m,
            'description'=>$request->description
        ]);
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        dd($id);
//
//        $discount=Discount::where('id',$id)->update(['numbers'=>'0']);
//        dd($discount);
    }

    public function deactive($id)
    {
        $discount=Discount::where('id',$id)->update(['numbers'=>'0']);
        return redirect()->back();
    }


}
