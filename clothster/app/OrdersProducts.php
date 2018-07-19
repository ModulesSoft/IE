<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrdersProducts extends Model
{
    //
    public $timestamps = false;
    public function order(){
        return $this->belongsTo(Orders::class);
    }
    public function products(){
    return $this->hasMany(Products::class);
}
}
