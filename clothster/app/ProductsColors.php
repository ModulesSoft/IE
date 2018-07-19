<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsColors extends Model
{
    //
    public function product(){
        return $this->belongsTo(Products::class);
    }
}
