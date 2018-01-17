<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Baskets extends Model
{
    protected $guarded=[];

    public function stuffs()
    {
        return $this->hasMany(Stuff::class);
    }

    public function discount()
    {
        return $this->hasOne(Discount::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
