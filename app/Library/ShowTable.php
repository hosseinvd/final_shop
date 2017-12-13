<?php
namespace App\Library;
use App\Product;

/**
 * Created by PhpStorm.
 * User: Hossein Vahid
 * Date: 13/12/2017
 * Time: 06:30 PM
 */
class ShowTable {
    public function EditProduct_image_ref($product_id)
    {
        $s_product=Product::find($product_id);

        echo "<input type='hidden' id='product_id' value='$s_product->id'>";
        foreach($s_product->images()->get() as $product_img) {
            echo "<div class='col-md-2'>";
            echo "<div class='thumbnail'>";
            echo "<img src='/product_image/$product_img->imagePath'";
            echo "class='m_admin_image img-rounded' alt='...'>";
            echo "<div class='caption'>";
            echo "<button type='button' class='btn btn-danger  our_button_d' id='$product_img->id'>حذف</button>";
            echo "</div>";
            echo "</div>";
            echo "</div>";
        }
    }
}