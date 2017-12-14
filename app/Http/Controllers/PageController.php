<?php

namespace App\Http\Controllers;

use App\page;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PageController extends Controller
{
    public function CreatePage()
    {
        return view('Admin.CreatePage');
    }

    public function StorePage(Request $request)
    {
        $page=new page;
        $page->body=$request->body;
        $page->title=$request->title;
        $page->slag=$request->title;
        $page->creator_id=Auth::user()->id;
        $page->save();
        return redirect(route('a_show_page',$page->id));
    }

    public function UpdatePage(Request $request)
    {
        $page=page::find($request->page_id);
        $page->body=$request->body;
        $page->title=$request->title;
        $page->slag=$request->title;
        $page->creator_id=Auth::user()->id;
        $page->save();
        return redirect(route('a_show_page',$page->id));
    }

    public function ShowPage($id)
    {
        $f_page=page::find($id);
        return view('Admin.ShowPage',compact('f_page'));
    }

    public function ShowEditPage()
    {
        $pages=page::paginate(10);
        return view('Admin.ShowEditPage',compact('pages'));
    }

    public function EditPages(Request $request)
    {
        $f_page=page::find($request->page_id);
        return view('Admin.EditPage',compact('f_page'));
    }
}
