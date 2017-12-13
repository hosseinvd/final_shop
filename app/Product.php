<?php

namespace App;
use App\m_image;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{

    protected $guarded=[];

    public function images()
    {
        return $this->hasMany('App\m_image');
    }
}
