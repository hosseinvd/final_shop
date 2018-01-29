<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reseller extends Model
{
    protected $guarded=[];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function reseller_info()
    {
        return $this->belongsTo(User::class,'reseller_id','id');
    }
}
