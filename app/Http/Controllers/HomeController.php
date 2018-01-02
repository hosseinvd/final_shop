<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('products');
    }

    public function comment(Request $request)
    {
        $this->validate($request,[
            'comment' => 'required|min:5'
        ]);

        $input=$request->except(['_token']);
        auth()->user()->comments()->create($input);
        return back();
    }
}
