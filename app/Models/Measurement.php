<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Measurement extends Model
{
    use HasFactory;


    public function productweight(){

        return $this->hasMany(ProductWeight::class);
    }

    public function carts(){

        return $this->hasMany(Cart::class);
    }

    //public function measurement(){

    //    return $this->belongsTo(Measurement::class);
    //}
}
