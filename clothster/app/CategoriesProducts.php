<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CategoriesProducts extends Model
{
    //
    public function category(){
        return $this->belongsTo(Categories::class);
    }
    public function product(){
        return $this->belongsTo(Products::class);
    }
}
