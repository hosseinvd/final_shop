<?php

namespace App;
use App\m_image;
use Gloudemans\Shoppingcart\Cart;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded=[];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }
    public function images()
    {
        return $this->hasMany('App\m_image');
    }

    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }
}
