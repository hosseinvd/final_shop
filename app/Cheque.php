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
}
