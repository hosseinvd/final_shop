<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
//    protected $fillable=['user_id','users_address_id','basket_id','pay_method', 'updated_at', 'created_at'];

    public function basket()
    {
        return $this->hasOne(Basket::class);
    }
    public function users_address(){
            return $this->belongsTo(Users_address::class);
    }
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
