<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];

    public function basket()
    {
        return $this->hasOne(Baskets::class);
    }
    public function address()
    {
        return $this->hasOne(Users_address::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
