<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Order extends Model
{
    use HasFactory;


    public function carts(){

        return $this->hasMany(Cart::class);
    }


    public function payment(){

        return $this->belongsTo(Payment::class,'payment_method');
    }


    public function division(){

        return $this->belongsTo(Division::class,'division_id');
    }

    public function district(){

        return $this->belongsTo(District::class,'district_id');
    }

    public static function orders(){

        $orders = Order::orderBy('id','desc')->where('ip_address',request()->ip())->get();

        return $orders;
    }

    public function product(){

        return $this->belongsTo(Product::class,'product_id');
    }

    public function productweight(){

        return $this->belongsTo(ProductWeight::class,'measurement_id');
    }        
}
