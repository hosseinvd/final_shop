<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Basket extends Model
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

    public function user_info()
    {
        return $this->belongsTo(Info_user::class,'user_id','user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function cheques()
    {
        return $this->hasMany(Cheque::class)->orderBy('created_at','ASC');
    }

    public function payments()
    {
        return $this->hasMany(Payment::class)->orderBy('created_at','ASC');
    }

    public function refund_basket()
    {
        return $this->hasOne(Basket::class , 'children_id' , 'id');
    }

}
