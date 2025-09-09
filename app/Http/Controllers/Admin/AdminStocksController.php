<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Stock;
use App\Models\Measurement;
use App\Models\Product;

class AdminStocksController extends Controller
{
    public function update(Request $request,$id){

        $stock = Stock::where('product_id',$id)->first();
        $measurement = Measurement::where('product_id',$id)->first();

        if($stock){


        }
        elseif{$measurement}{


        }


    }
}
