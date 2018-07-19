<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    //
    public function products(){
        return $this->hasMany(OrdersProducts::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
