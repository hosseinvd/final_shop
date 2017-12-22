<?php

namespace App\Library;

use App\Product;
use App\Role;
use App\User;

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
        $users = User::where('name','LIKE', "%$user_name%")->get();

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
                <a class='button is-outlined m-l-5 btn btn-success ' href='".
                route('users.show', $user->id)."'>View</a> 
                <a class='button is-light btn btn-warning' href='".
                route('users.edit', $user->id)."'>Edit</a>
                </td>
                </tr>";
        };
        echo "</tbody></table>";

    }

}