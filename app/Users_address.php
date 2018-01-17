<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_address extends Model
{
    protected $guarded=[];

    public function user()
    {
        return $this->hasMany(User::class);
    }
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
