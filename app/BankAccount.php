<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payer()
    {
        return $this->belongsTo(Info_user::class , 'payer_id' , 'user_id');
    }

    public function pay_to()
    {
        return $this->belongsTo(Info_user::class , 'pay_to_id' , 'user_id');
    }

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
}
