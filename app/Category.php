<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded=[];

    public function products()
    {
        return $this->belongsToMany('App\Product');
    }


    public function categories()
    {
        return $this->hasMany(Category::class , 'parent_id' , 'id');
    }



}
