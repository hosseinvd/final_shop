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

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
