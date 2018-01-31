<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info_user extends Model
{
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function seller()
    {
        return $this->hasone(Info_user::class,'user_id','seller_id');
    }

    //relation has many mean go to the releted table and then find all row where Column_name=foreignKey columns==local key value
    public function resellers()
    {
        return $this->hasMany(Info_user::class , 'seller_id' , 'user_id');
    }
}
