<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $guarded=[];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
    public function cheque()
    {
        return $this->hasone(Cheque::class);
    }
    public function user_info()
    {
        return $this->belongsTo(Info_user::class,'user_id','user_id');
    }
}
