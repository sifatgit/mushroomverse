<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\ProductWeight;
use App\Models\Product;
use App\Models\Brand;
use App\Models\Measurement;
use Auth;

class CartsController extends Controller
{


  public function index()
  {                               
                                
    return view ('frontend.pages.carts');
  }


  public function detect_price($id){

    $weight = ProductWeight::find($id);

    return response()->json($weight);

  }

  public function store(Request $request)
  {

      $validated = $request->validate([
          'product_id' => 'required|integer',
          'measurement_id' => 'required|integer',
          'brand_id' => 'nullable|integer',
          'productweight_id' => 'required|integer',
          'product_quantity' => 'nullable|integer',

      ]);

    //if (Auth::check()) {
    //  $cart = Cart::where('user_id', Auth::id())
    //  ->where('product_id', $request->product_id)
    //  //->where('order_id', NULL)
    //  ->first();
    //}else {
    //  $cart = Cart::where('ip_address', request()->ip())
    //  ->where('product_id', $request->product_id)
    //  ->where('order_id', NULL)
    //  ->where('brand_id',$request->brand_id)
    //  ->where('measurement_id',$request->measurement_id)
    //  ->first();
    //}

    $product = Product::where('id', $request->product_id)->first();
    $measurement = Measurement::where('id',$request->measurement_id)->first();
    $productweight = ProductWeight::where('id',$request->productweight_id)->first();    

    $same_cart = Cart::where('product_title',$product->title)->where('measurement_weight',$measurement->weight)->where('ip_address',request()->ip())->where('order_id',NULL)->first();

    if($productweight->product->category->type == 2){
      if($productweight->quantity > 0){
        if($productweight->quantity >= $request->product_quantity){
        if($same_cart){

        return response()->json(['status' => 'warning','message'=>'Item already added!']);
      }

      else{


        $cart = new Cart;

        $cart->category_type = $product->category->type;
        $cart->product_weight_id = $productweight->id;
        $cart->measurement_weight = $measurement->weight;

        if($request->brand_id){
         $brand = Brand::where('id',$request->brand_id)->first();
         $cart->brand_name = $brand->name; 
        }
        
        $cart->ip_address = request()->ip();

        if($request->product_quantity){
        $cart->product_quantity = $request->product_quantity;        
        }
        else{
        $cart->product_quantity = 1;  
        }

        $cart->product_id = $product->id;
        $cart->product_title = $product->title;

        $images = explode("|",$product->images);

        if($images){

          $cart->product_image = $images[0];
        }

        $cart->product_price = $productweight->price;

        //$cart->user_id = 1;


        $cart->save();

        $carts = Cart::totalCarts();

        $latest_cart = $cart;
        $total_carts = count($carts);


        return response()->json(['status'=> 'success', 'total_carts' => $total_carts,'latest_cart' => $latest_cart,'message' => 'Product added successfully!']);


        //return back();

      }           
        }
        else{

          return response()->json(['status' => 'warning', 'message' => 'Please select lesser quantity!']);
        }

     
      }
      else{
       return response()->json(['status' => 'error' ,'message' => 'Item no  longer availabile!']); 
      }      
    }
    if($productweight->product->category->type != 2){
        if($productweight->availability == 1){

          if($same_cart){

          return response()->json(['status' => 'warning','message'=>'Item already added!']);
        }

        else{


          $cart = new Cart;

          $cart->category_type = $product->category->type;
          $cart->product_weight_id = $productweight->id;
          $cart->measurement_weight = $measurement->weight;

          if($request->brand_id){
           $brand = Brand::where('id',$request->brand_id)->first();
           $cart->brand_name = $brand->name; 
          }
          
          $cart->ip_address = request()->ip();

          if($request->product_quantity){
          $cart->product_quantity = $request->product_quantity;        
          }
          else{
          $cart->product_quantity = 1;  
          }
          
          $cart->product_id = $product->id;
          $cart->product_title = $product->title;

          $images = explode("|",$product->images);

          if($images){

            $cart->product_image = $images[0];
          }

          $cart->product_price = $productweight->price;

          //$cart->user_id = 1;


          $cart->save();

          $carts = Cart::totalCarts();
          
          $latest_cart = $cart;
          
          $total_carts = count($carts);


          return response()->json(['status'=> 'success', 'total_carts' => $total_carts,'latest_cart' => $latest_cart,'message' => 'Product added successfully!']);


          //return back();

        }      
        }
        else{
         return response()->json(['status' => 'error','message' => 'Item no  longer availabile!']); 
        } 
    }  








    
    //return json_encode(['status' => 'success', 'Message' => 'Item added to cart', 'totalItems' => Cart::totalItems(), 'totalprice' => Cart::totalprice()]);

    //return back()->with('success','Product added to cart successfully!');

}

    public function update(Request $request,$id){

      $validated = $request->validate([
          'product_quantity' => 'nullable|integer',
      ]);

    
    $cart = Cart::find($id);


    if($cart->category_type == 2){
      if($cart->productweight->quantity >= $request->product_quantity){
      
      $cart->product_quantity = $request->product_quantity;
      
      $cart->save();

      return response()->json(['status' => 'success','message' => 'Cart updated successfully!'  ]);

      }

      elseif($cart->productweight->quantity == 0){

        $cart->delete();

        return response()->json(['status' => 'delete','message' => 'Item no longer availabile!']);
      }

      else{

        return response()->json(['status' => 'warning']);
      }
    }

    else{

      if($cart->productweight->availability == 1){

        $cart->product_quantity = $request->product_quantity;
        
        $cart->save();

        return response()->json(['status' => 'success','message' => 'Cart updated successfully!' ]);
      }
      else{

        $cart->delete();
        
        return response()->json(['status' => 'delete','message' => 'Item no longer availabile!' ]);

      }
      
    }




    //return json_encode(['status' => 'success', 'Message' => 'Item added to cart', 'totalItems' => Cart::totalItems(), 'totalprice' => Cart::totalprice()]);

    //return back()->with('success','Cart updated successfully!');      



    }


    public function remove($id){

      $cart = Cart::find($id);

      $cart->delete();

      return response()->json();

    }
}
