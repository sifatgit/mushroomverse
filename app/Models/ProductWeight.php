<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductWeight extends Model
{
    use HasFactory;

    protected static function boot(){

        parent::boot();

        static::deleting(function ($ProductWeight) {
            // Detach carts only if they do not have an order_id
            $ProductWeight->cart()->whereNull('order_id')->delete();
        });
    }    


    public function measurement(){

        return $this->belongsTo(Measurement::class);
        
    }
    public function product(){

        return $this->belongsTo(Product::class,'product_id');
    }

    public function brand(){

        return $this->belongsTo(Brand::class);
    }

    public function cart(){

        return $this->hasMany(Cart::class);
    }  

}
