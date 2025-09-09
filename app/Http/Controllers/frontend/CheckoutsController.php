<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class CheckoutsController extends Controller
{
    public function index(){


        return view('frontend.pages.checkouts');
    }

    public function single_order_checkout(Request $request){

        $product = $request->only(['product_id' , 'product_title' , 'weight_id' , 'amount' , 'quantity']);

        return view('frontend.pages.single_order_checkout',compact('product'))
        ;
    }

}
