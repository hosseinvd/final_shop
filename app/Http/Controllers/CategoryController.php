<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function CreateProductCategory()
    {

        $categories=Category::paginate(8);
        return view('Admin.CreateProductCategory',compact('categories'));
    }

    public function CreateCategory(request $request)
    {
        $category=new Category;
        $category->name=$request->name;
        $category->description=$request->description;
        $category->save();
        return 'Create done';
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
