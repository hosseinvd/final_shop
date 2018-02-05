<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CreateProductCategory()
    {

        $categories_p=Category::paginate(8);
        $categories = Category::where('parent_id','0')->get();

        return view('Admin.CreateProductCategory',compact('categories','categories_p'));
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
        $category->save();
        return 'Edit done';
    }
    public function DeleteCategory(request $request)
    {
        Category::destroy($request->id);
        return 'Delete done';
    }
}
