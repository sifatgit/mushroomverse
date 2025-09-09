<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

class PagesController extends Controller
{
    public function about_us(){

        return view('frontend.pages.about_us');
    }

    public function contact_us(){

        return view('frontend.pages.contact_us');
    } 

    public function privacy_policy(){

        return view('frontend.pages.privacy_policy');
    }

    public function terms_condition(){

        return view('frontend.pages.terms_conditions');
    }    

    public function delivery_information(){

        return view('frontend.pages.delivery_information');
    }    
    
    public function location(){

        return view('frontend.pages.location');
    } 

    public function search(Request $request)
    {
        $search = $request->input('search'); // Fetch the query parameter

        $products = Product::where('title', 'LIKE', '%' . $search . '%')
                           ->orWhere('slug', 'LIKE', '%' . $search . '%')
                           ->orderBy('id', 'desc')
                           ->get();
        if(!is_null($products)){

            return response()->json(['products' => $products , 'search' => $search]);

        }
        else{

            $products = Null;

            return response()->json(['products' => $products]);
        }                   

        
    }
       

    public function product_search(){

        $search = $_GET['search'];

        $products = Product::where('title','LIKE','%'.$search.'%')
                    ->orWhere('slug','LIKE','%'.$search.'%')
                    ->orderBy('id','desc')
                    ->get();


        return view('frontend.pages.searches',compact('search','products'));

    }

        public function link_product_search($query){

        $search = $query;

        $products = Product::where('title','LIKE','%'.$search.'%')
                    ->orWhere('slug','LIKE','%'.$search.'%')
                    ->orderBy('id','desc')
                    ->get();


        return view('frontend.pages.searches',compact('search','products'));

    }
}
