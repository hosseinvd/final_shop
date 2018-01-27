<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $guarded=[];
//    protected $fillable=['user_id','users_address_id','basket_id','pay_method', 'updated_at', 'created_at'];

    public function baskets()
    {
        return $this->hasMany(Basket::class)->orderBy('created_at','ASC');
    }
    public function users_address(){
            return $this->belongsTo(Users_address::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function info_user()
    {
        return $this->belongsTo('App\Info_user');
    }

}
