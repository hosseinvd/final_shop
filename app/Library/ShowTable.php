<?php

namespace App\Library;

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

        echo "<div class='table-responsive' id='C_table'>";
        echo "
        <table class='table'>
        <thead>
        <tr>
            <th>#</th>
            <th>Product Name</th>
            <th>Quantity</th>
            <th>refresh</th>
            <th>Product Price</th>
            <th>tax</th>
            <th>Totla row Price</th>

        </tr>
        </thead>
        <tbody>
        ";
        $i = 0;
        $total=Cart::total();
        $tax=Cart::tax();
        $subtotal=Cart::subtotal();
        foreach (Cart::content() as $row) {
            $i++;
            echo "
                <tr>
                    <td>$i</td>
                    <td><p><strong>$row->name</strong></p></td>
                    <td>
                        <input class='form-control' id='row_id_$i' type='hidden' name='row_id[]' value='$row->rowId'>
                        <input class='form-control' id='row_qty_$i' type='number' name='row_qty[]' value='$row->qty'>
                    </td>
                    <td>
                        <button  type='button' class='btn btn-warning ' id='refresh' value='$i'><i class='fa fa-refresh' aria-hidden='true'></i></button>
                    </td>
                    <td>$row->price</td>
                    <td>$row->qty*$row->tax</td>
                    <td>$row->total</td>
                </tr>
                ";
        };

        echo "
        </tbody>
                    <tfoot>
                    <tr>
                        <td colspan='2'>&nbsp;</td>
                        <td>Subtotal</td>
                        <td>$subtotal</td>
                    </tr>
                    <tr>
                        <td colspan='2'>&nbsp;</td>
                        <td>Tax</td>
                        <td>$tax</td>
                    </tr>
                    <tr>
                        <td colspan='2'>&nbsp;</td>
                        <td>Total</td>
                        <td>$total</td>
                    </tr>

                    </tfoot>
                </table>
        ";

    }

}