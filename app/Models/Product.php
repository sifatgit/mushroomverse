<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;


    public function category(){

        return $this->belongsTo(Category::class,'category_id');
    }

    public function cart(){

        return $this->hasMany(Cart::class);
    }

    public function stock(){

        return $this->hasOne(Product::class);
    }

    public function productweight(){

        return $this->hasMany(ProductWeight::class);
    }

    public function brand(){

        return $this->belongsTo(Brand::class);
    }

    public function wishlist(){

        return $this->hasMany(Wishlist::class);
    }    

    
}
