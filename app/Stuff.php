<?php

namespace App;

use Gloudemans\Shoppingcart\Cart;
use Illuminate\Database\Eloquent\Model;

class Stuff extends Model
{
    protected $guarded=[];

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
