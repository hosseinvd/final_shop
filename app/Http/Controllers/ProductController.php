<?php

namespace App\Http\Controllers;

use App\Category;
use App\Http\Requests\StoreProduct;
use App\m_image;
use App\Product;
use Carbon\Carbon;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;


class ProductController extends AdminController
{
    public function getIndex()
    {
        $products=Product::paginate(6);

        return view('shop.index',compact('products'));
    }

    public function CreateProducts()
    {
        $categories=Category::all();
        return view('Admin.CreateProducts',compact('categories'));
    }

    public function UploadImage_ckeditor()
    {
        $this->validate(request() , [
            'upload' => 'required|mimes:jpeg,png,bmp',
        ]);

        $year = Carbon::now()->year;
        $imagePath = "/product_image/CK_images/";

        $file = request()->file('upload');
        $filename = $file->getClientOriginalName();

        if(file_exists(public_path($imagePath) . $filename)) {
            $filename = Carbon::now()->timestamp . $filename;
        }

        $file->move(public_path($imagePath) , $filename);
        $url = $imagePath . $filename;

        return "<script>window.parent.CKEDITOR.tools.callFunction(1 , '{$url}' , '')</script>";


    }

    public function Store(Request $request)
    {

//        $input_product=$request->except(['_token','images']);

        $product = new Product;
        $product->title = $request->title;
        $product->price = $request->price;
        $product->discount = $request->discount;
        $product->inventory = $request->inventory;
        $product->weight = $request->weight;
        $product->size = $request->size;
        $product->color = $request->color;
        $product->warranty = $request->warranty;
        $product->category_id = $request->category_id;
        $product->description = $request->description;
        $product->long_description = $request->long_description;
        $product->save();
        $file=$request->file('images');
        if($file) {
            $imagesUrl = $this->uploadImages($file);
            $product->images()->saveMany([
                new m_image(['imagePath' => $imagesUrl['images']['600'], 'imageSize' => '600']),
                new m_image(['imagePath' => $imagesUrl['images']['240'], 'imageSize' => '240']),
            ]);
        }

            return view('Admin.CreateProducts');

    }

    public function Products()
    {
        $products=Product::paginate(6);
        return view('Admin.Products',compact('products'));
    }

    public function DeleteProducts(Request $request)
    {
        $product=Product::find($request->id);
        $product->delete();
        return "Delete Success";
    }

    public function EditProducts(Request $request)
    {
        $categories=Category::all();

        $s_product=Product::find($request->product_id);

        return view('Admin.EditProduct',compact('categories','s_product'));
    }

    public function EditProducts_Add_image(Request $request)
    {

        $file=$request->file('file');
        if($file) {
            $imagesUrl = $this->uploadImages($file);
//            $product->images()->saveMany([
//                new m_image(['imagePath' => $imagesUrl['images']['600'], 'imageSize' => '600']),
//                new m_image(['imagePath' => $imagesUrl['images']['240'], 'imageSize' => '240']),
//            ]);
        }
    }

    public function addToCart(Product $product)
    {
        Cart::add($product->id,$product->title,1,$product->price);

        return back();
    }



}
