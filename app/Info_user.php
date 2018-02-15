<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Info_user extends Model
{
    protected $guarded=[];

    //return $this->belongsTo('App\User',user_id,id);
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

    //If your parent model does not use id as its primary key, or you wish to join the child model to a different column,
    // you may pass a third argument to the belongsTo method specifying your parent table's custom key:
    //relation has many mean go to the releted table and then find all row where Column_name=foreignKey columns==local key value
    public function resellers()
    {
        return $this->hasMany(Info_user::class , 'seller_id' , 'user_id');
    }

    public function cheques()
    {
        return $this->hasMany(Cheque::class , 'user_id' , 'user_id');
    }
}
