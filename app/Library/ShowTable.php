<?php

namespace App\Library;

use App\Info_user;
use App\Product;
use App\Role;
use App\User;
use Gloudemans\Shoppingcart\Facades\Cart;

class ShowTable
{
    public function EditProduct_image_ref($product_id)
    {
        $s_product = Product::find($product_id);

        echo "<input type='hidden' id='product_id' value='$s_product->id'>";
        foreach ($s_product->images()->get() as $product_img) {
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

    public function find_user($user_name)
    {
        $users = User::where('name', 'LIKE', "%$user_name%")->get();

        echo "<table class='table table-striped'>";
        echo "<thead>
              <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>                    
                    <th>Date Created</th>
                    <th></th>
              </tr>
              </thead>
              <tbody>";
        foreach ($users as $user) {
            echo "
                <tr>
                <th>$user->id</th>
                <td>$user->name</td>
                <td>$user->email</td>
                <td>$user->created_at</td>
                <td class='has-text-right'>
                <a class='button is-outlined m-l-5 btn btn-success ' href='" .
                route('users.show', $user->id) . "'>View</a> 
                <a class='button is-light btn btn-warning' href='" .
                route('users.edit', $user->id) . "'>Edit</a>
                </td>
                </tr>";
        };
        echo "</tbody></table>";
    }

    public function user_sel($user_name)
    {
        $user_id_default=\Auth::user()->id;
        if (mb_strlen($user_name, 'UTF-8') > 3) {
            echo "<table class='table table-striped table-advance table-hover' style='direction: rtl;'>";
            echo "<thead>";
            echo "<tr>";
            echo "<th></th>";
            echo "<th>نام</th>";
            echo "<th>نام خانوادگی</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

            $results= Info_user::where('family', 'LIKE', "%$user_name%")->get();

            if ($results != false) {
                $i = 1;
                foreach ($results as $result) {
                    echo "<tr>";
                    echo "<td><input type='radio' name='user_id' id='user_id' value='$result->user_id'></td>";
                    echo "<td>$result->name</td>";
                    echo "<td>$result->family</td>";
                    echo "</tr>";
                    $i++;
                }
            } else {
                echo "<tr>";
                echo "<td><input type='hidden' name='user_id' id='user_id' value='$user_id_default'  checked></td>";
                echo "<td colspan='4'>نتیجه ای یافت نشد.</td>";
                echo "</tr>";
                echo "</tbody>";
                echo "</table>";
            }
        }
        else {
            echo "<div class='alert alert-info fade in' style='direction: rtl;'>														
			برای جستجو فردی به ورود بیش از 3 کاراکتر (حرف یا عدد) نیاز است.
			</div>
			<input type='hidden' name='user_id' id='user_id' value='$user_id_default'  checked>";
        }
    }

    public function user_sort_role($role_id)
    {
        $roles = Role::where('id', $role_id)->with('users')->first();

        echo "<table class='table table-striped'>";
        echo "<thead>
              <tr>
                    <th>id</th>
                    <th>Name</th>
                    <th>Email</th>                    
                    <th>Date Created</th>
                    <th></th>
              </tr>
              </thead>
              <tbody>";
        foreach ($roles->users as $user) {
            echo "
                <tr>
                <th>$user->id</th>
                <td>$user->name</td>
                <td>$user->email</td>
                <td>$user->created_at</td>
                <td class='has-text-right'>
                <a class='button is-outlined m-l-5 btn btn-success ' href='" .
                route('users.show', $user->id) . "'>View</a> 
                <a class='button is-light btn btn-warning' href='" .
                route('users.edit', $user->id) . "'>Edit</a>
                </td>
                </tr>";
        };
        echo "</tbody></table>";

    }


    public function user_basket()
    {
        $i = 0;
        $total=Cart::total();
        $tax=Cart::tax();
        $subtotal=Cart::subtotal();
        $route_products=route('products');
        echo "<div class='table-content table-responsive'>
        <table>
        <thead>
        <tr>
            <th>ردیف</th>
            <th class=\"product-thumbnail\">تصویر</th>
            <th class=\"product-name\">محصول</th>
            <th class=\"product-quantity\">تعداد</th>
            <th>refresh</th>
            <th class=\"product-price\">قیمت</th>
            <th class=\"product-subtotal\">جمع</th>
            <th class=\"product-remove\">حذف</th>
        </tr>
        </thead>
        <tbody>
        ";
        foreach (Cart::content() as $row) {
            $i++;
            if((\App\Product::find($row->id)->images()->exists())){
                $image_path = asset('product_image') . '/' . \App\Product::find($row->id)->images()->first()->imagePath;

            }else
            {
                $image_path = asset('images/picture-not-available.jpg');

            }
            $product_address = route('show_product', $row->id);
            echo "
                            <tr>
                            <td>$i</td>
                            <td class='product-thumbnail'>
                                <img  src='$image_path'
                                      alt='...'>
                            </td>
                            <td class='product-name'>
                                <a href='$product_address'>
                                    <p><strong>$row->name</strong></p>
                                </a>
                            </td>
                            <td class='product-quantity'>
                                <input class='form-control' id='row_id_$i' type='hidden' name='row_id[]'
                                       value='$row->rowId'>
                                <input class='form-control row_qty' id='row_qty_$i' type='number' name='row_qty[]'
                                       value='$row->qty'>
                            </td>
                            <td>
                                <button type='button' class='btn btn-warning ' id='refresh' value='$i'><i
                                            class='fa fa-refresh' aria-hidden='true'></i></button>
                            </td>
                            <td class='product-price'>$row->price</td>                        
                            <td class='product-subtotal'>$row->subtotal</td>
                            <td>
                               <button type='button' class='btn btn-danger ' id='delete_row' value=''$row->rowId'><i
                                class='fa fa-trash' aria-hidden='true'></i></button>
                            </td>                                   
                </tr>
                 ";
        };
        echo "
        </tbody>
        </table>
        </div>
        ";
        $user_checkout=route('user-checkout');
        echo "
            <div class='row'>
                <div class='col-md-9 col-sm-7 col-xs-12'>
                    <div class='buttons-cart'>
                        <input type='submit' value='به روز رسانی سبد'>
                        <a href='$route_products'>ادامه خرید</a>
                    </div>
                    <div class=\"coupon\">
                            <h3>کد تخفیف</h3>
                            <p>کد تخفیف یا کد معرف خود را در صورت وجود وارد نمایید</p>
                            <input type=\"text\" id=\"discount_code\" placeholder=\"کد تخفیف\">
                            <div class=\"col-md-3 col-sm-5 col-xs-12\">
                            <input type=\"button\" id=\"discount\" value=\"اعمال تخفیف\">
                            </div>
                     </div>
                </div>
                <div class='col-md-3 col-sm-5 col-xs-12'>
                    <div class='cart_totals'>
                        <h2>مجموع سبد</h2>
                        <div id='pay_value'>
                        <table>
                            <tbody>
                            <tr class='cart-subtotal'>
                                <th>زیر مجموعه</th>
                                <td><span class='amount'>$subtotal <small>تومان</small></span></td>
                            </tr>
                            <tr class='cart-subtotal'>
                                <th>مالیات</th>
                                <td><span class='amount'>$tax <small>تومان</small></span></td>
                            </tr>
                            <tr class='order-total'>
                                <th>جمع</th>
                                <td>
                                    <strong><span class='amount'>$total <small>تومان</small></span></strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
                        </div>
                        <div class=\"wc-proceed-to-checkout\">
                                <a href='$user_checkout'>پرداخت</a>
                        </div>
                    </div>
                </div>            
            </div>            
        ";

    }

    public function user_basket_discount($discount)
    {
        $i = 0;
        $total=Cart::total();
        $tax=Cart::tax();
        $subtotal=Cart::subtotal();
        $route_products=route('products');
        $user_checkout=route('user-checkout');
        $total_with_disc=$total-$discount;
        echo "
                        
                        <table>
                            <tbody>
                            <tr class='cart-subtotal'>
                                <th>زیر مجموعه</th>
                                <td><span class='amount'>$subtotal <small>تومان</small></span></td>
                            </tr>
                            <tr class='cart-subtotal'>
                                <th>تخفیف</th>
                                <td>
                                    <strong><span class='amount'>$discount <small>تومان</small></span></strong>
                                </td>
                            </tr>
                            <tr class='cart-subtotal'>
                                <th>مالیات</th>
                                <td><span class='amount'>$tax <small>تومان</small></span></td>
                            </tr>
                            <tr class='order-total'>
                                <th>جمع</th>
                                <td>
                                    <strong><span class='amount'>$total <small>تومان</small></span></strong>
                                </td>
                            </tr>                            
                            <tr class='order-total'>
                                <th>مبلغ قابل پرداخت</th>
                                <td>
                                    <strong><span class='amount'>$total_with_disc <small>تومان</small></span></strong>
                                </td>
                            </tr>
                            </tbody>
                        </table>
        ";

    }


}