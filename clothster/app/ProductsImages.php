<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProductsImages extends Model
{
    //
    public function product(){
        return $this->belongsTo(Products::class);
    }
}
