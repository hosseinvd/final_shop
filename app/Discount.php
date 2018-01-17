<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Discount extends Model
{
    protected $guarded=[];

    public function baskets()
    {
        return $this->hasmany(Baskets::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
