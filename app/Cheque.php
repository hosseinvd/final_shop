<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cheque extends Model
{
    protected $guarded=['id'];

    public function basket()
    {
        return $this->belongsTo(Basket::class);
    }
    public function user_info()
    {
        return $this->belongsTo(Info_user::class,'user_id','user_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }

}
