<?php

namespace App\Http\Controllers;

use App\Category;
use App\ImageM;
use App\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;

class AdminController extends Controller
{
    public function Dashboard()
    {
          return view('Admin.Dashboard');
    }

    protected function uploadImages($file)
    {
        $year=Carbon::now()->month;
        $imagePath="/product_image/";//create image path
        $filename=time().$file->getClientOriginalName();
        $file=$file->move(public_path($imagePath),$filename);
        $sizes=["240","600"];
        $url['images']=$this->resize($file->getRealPath(),$sizes,$imagePath,$filename);
        $url['thumb']=$url['images'][$sizes[1]];
        return $url;

    }

    private function resize($path , $sizes , $imagePath , $filename)
    {
        $images['original'] = $imagePath . $filename;
        foreach ($sizes as $size) {
//            $images[$size] = $imagePath . "{$size}_" . $filename;
            $images[$size] = "{$size}_" . $filename;
            Image::make($path)->resize($size, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(public_path($imagePath .$images[$size]));
        }

        return $images;
    }

}
