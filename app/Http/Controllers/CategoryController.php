<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use App\Library\ShowTable;

class CategoryController extends Controller
{
    public function CreateProductCategory()
    {

        $categories_p=Category::paginate(8);
        $categories = Category::where('parent_id','0')->get();

        $showTBL=new ShowTable;
        $cat_html=$showTBL->category_tree();

        return view('Admin.CreateProductCategory',compact('categories','categories_p','cat_html'));
    }

    public function CreateCategory(request $request)
    {
        $category=new Category;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->parent_id=$request->category_id;
        $category->save();
        return redirect()->route('a_CreateProductCategory');
    }

    public function EditCategory(request $request)
    {
        $category=Category::find($request->id);
        $category->name=$request->name;
        $category->description=$request->description;
        if($request->sel_parent_id>=0) {
           $category->parent_id = $request->sel_parent_id;
        }
        $category->save();
        return 'Edit done';
    }
    public function DeleteCategory(request $request)
    {
        Category::destroy($request->id);

        return 'Delete done';
    }
}
