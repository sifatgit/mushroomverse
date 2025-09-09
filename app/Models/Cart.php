<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

  //public static function totalCarts()
  //{
  //  if (Auth::check()) {
  //    $carts = Cart::where('user_id', Auth::id())
  //    ->where('order_id', NULL)
  //    ->get();
  //  }else {
  //    $carts = Cart::where('ip_address', request()->ip())->where('order_id', NULL)->get();
  //  }
  //  return $carts;
  //}

    public static function totalCarts(){


      $main_carts = Cart::where('ip_address',request()->ip())->where('order_id',NULL)->get();

      //if(count($main_carts) > 0){

              foreach($main_carts as $cart){

                if($cart->productweight->product->category->type == 2){

                   if($cart->productweight->quantity < $cart->product_quantity){
                      if($cart->productweight->quantity == 0){

                      $cart->delete(); 
                    
                    }
                      else{
                      $decrement = $cart->product_quantity - $cart->productweight->quantity;

                      $cart->decrement('product_quantity',$decrement);
                      $cart->save();  
                    }


                  }         
                }
                else{
                    
                      if($cart->productweight->availability == 0){
                        
                       $cart->delete();  
                      }            
                    
                }


              }       

      return $carts = $main_carts;        
      //}

    }

/**
 * total Items in the cart
 * @return integer total item
 */
  public static function totalItems()
  {
    $carts = Cart::totalCarts();

    $total_item = 0;

    foreach ($carts as $cart) {
      $total_item += $cart->product_quantity;
    }
    return $total_item;
  }

  public static function totalprice(){

    $carts = Cart::totalCarts();

    $total_price = 0;

    foreach($carts as $cart){

      $total_price += $cart->product->price * $cart->product_quantity;
    }

    return $total_price;
  }

  public function product(){

    return $this->belongsTo(Product::class,'product_id');
  }

  public function brands(){

    return $this->belongsTo(Brand::class);
  }

  public function measurements(){

    return $this->belongsTo(Measurement::class,'measurement_id');
  }

  public function productweight(){

    return $this->belongsTo(ProductWeight::class,'product_weight_id');
  }
   

  public function order(){

    return $this->belongsTo(Order::class,'order_id');
  }  
}
