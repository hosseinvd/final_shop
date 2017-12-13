<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class m_image extends Model
{
    protected $guarded=[];
    public function product(){

        $this->belongsTo('App\Product');
    }
}
