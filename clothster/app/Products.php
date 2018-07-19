<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    public function category(){
        return $this->belongsTo(CategoriesProducts::class);
    }
    public function colors(){
        return $this->hasMany(ProductsColors::class);
    }
    public function images(){
        return $this->hasMany(ProductsImages::class);
    }
    public function sizes(){
        return $this->hasMany(ProductsSizes::class);
    }
}
