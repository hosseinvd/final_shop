<?php

namespace App\Http\Controllers;
use Alert;
use App\Item;
use Illuminate\Http\Request;

class ajaxController extends Controller
{
    public function index(request $request)
    {
        $items=Item::all();
//        alert()->success('Success Message', 'Optional Title');
        return view('test_ajax',compact('items'));
    }

    public function create(request $request)
    {
        $item = new Item;
        $item->item = $request->text;
        $item->save();
        $items = Item::all();

        $html='<h1> Back data from </h1>';

        return $html;
    }
}
