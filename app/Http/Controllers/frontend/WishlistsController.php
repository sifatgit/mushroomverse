<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Wishlist;
use App\Models\Product;

class WishlistsController extends Controller
{
    public function index(){

        $wishlist = Wishlist::where('ip_address',request()->ip())->get();

        return view('frontend.pages.wishlist',compact('wishlist'));
    }


    public function store(Request $request,$product_id){


        $wishlist = Wishlist::where('product_id',$product_id)->where('ip_address',request()->ip())->first();

        if($wishlist){

            $wishlist->delete();

            return response()->json(['status' => 'info','message'=>'Product removed from wishlist!']);
        }

        else{

            $wishlist = new Wishlist;
            $wishlist->ip_address = request()->ip();
            $wishlist->product_id = $product_id;
            $product = Product::where('id',$product_id)->first();
            $wishlist->category_type = $product->category->type;
            $wishlist->product_title = $product->title;
            $wishlist->product_description = $product->description;

            $images = explode("|",$product->images);

            // Check if there are images and assign the first image to the wishlist
            if (count($images) > 0 && !empty($images[0])) {
                $wishlist->product_image = $images[0];  // Store the first image path
            }


            $wishlist->save();

            return response()->json(['status' => 'success','message'=>'Product added to wishlist!']);                       
        }



        
    }

    public function remove($id){

        $wishlist = Wishlist::find($id);

        $wishlist->delete();

        return response()->json(['status' => 'success']);
    }
}
