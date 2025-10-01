<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Measurement;
use App\Models\ProductWeight;

class AdminProductsController extends Controller
{


        public function store(Request $request){

        $validated = $request->validate([
            'category_id' => 'required|integer|exists:categories,id',
            'brand_id' => 'nullable|integer|exists:brands,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:2000',
            'slug' => 'nullable|string|unique:products,slug|max:255',
            'price' => 'required|integer|min:1',
            'images.*' => 'required|image|mimes:jpeg,jpg,png|max:2048',
        ]);




        $product = new Product;


        $product->category_id = $request->category_id;


        $product->brand_id = $request->brand_id;            

        $product->title = $request->title;
        $product->description = $request->description;
        $product->slug = $request->title;
        $product->price = $request->price;
        $product->admin_id = 1; //default

       $images=array();
        if($files=$request->file('images')){
            $i=0;
            foreach($files as $file){
                $name=time().rand(1,99).'.'.$file->extension();
                $fileNameExtract=explode('.',$name);
                $fileName=$fileNameExtract[0];
                $fileName.=$i;
                $fileName.='.';
                $fileName.=$fileNameExtract[1];
                $path = 'admin/images/products/';
                $file->move($path,$fileName);
                $image_url = $path.$fileName;
                $images[]=$image_url;
                $i++;
            }
            $product['images'] = implode("|",$images);
        }
        
                  
               
        $product->save();



        return redirect()->route('admin.products')->with('success','Product has been added successfully!');

        }

        
        public function update(Request $request,$id){

        $validated = $request->validate([
            'category_id' => 'required|integer',
            'brand_id' => 'required|integer',
            'title' => 'required|string',
            'description' => 'required|string',
            'slug' => 'required|string',
            'price' => 'required|integer',
        ]);

            $product = Product::find($id);


            $product->category_id = $request->category_id;
            $product->brand_id = $request->brand_id;
            $product->title = $request->title;
            $product->description = $request->description;
            $product->slug = $request->title;
            $product->price = $request->price;
            $product->admin_id = 1;

            if($request->featured){

                $product->featured = $request->featured;

            }
            else{
                
                $product->featured = 0;
            }
            if($request->sale){

                $product->sale = $request->sale;   
            }
            else{

                $product->sale = 0;
            }
             

             

            $images=array();
            if($files=$request->file('images')){

               if(!is_null($product->images)){

                    $img = explode("|",$product->images);
                    foreach($img as $pic){
                        unlink($pic);

                        
                    }

               }
                $i=0;
                foreach($files as $file){
                    $name=time().rand(1,99).'.'.$file->extension();
                    $fileNameExtract=explode('.',$name);
                    $fileName=$fileNameExtract[0];
                    $fileName.=$i;
                    $fileName.='.';
                    $fileName.=$fileNameExtract[1];
                    $path = 'admin/images/products/';
                    $file->move($path,$fileName);
                    $image_url = $path.$fileName;
                    $images[]=$image_url;
                    $i++;
                }
                $product['images'] = implode("|",$images);


            }

            $product->save();
            
            return redirect()->route('admin.products')->with('success','Product has been updated successfully!');


        }

        public function delete($id){

            $product = Product::find($id);

            if($product){

                if(!is_null($product->images)){

                    $img = explode("|",$product->images);
                    foreach($img as $pic){
                        unlink($pic);

                        
                    }

               }
               foreach($product->productweight as $prowgt){

                foreach($prowgt->cart as $wgt_cart){

                    if($wgt_cart->order_id == NULL){
                        $wgt_cart->delete();                        
                    }


                }

                    $prowgt->delete();

               }

               $product->delete();

               return back()->with('success','Product has been deleted successfully!');

            }
               





        }


        public function manage_weights(){

            $data = ProductWeight::all();

            return view('backend.pages.products.manage_weights',compact('data'));
        }

        public function weight_store(Request $request){

            $product_weight =  ProductWeight::where('product_id',$request->product_id)->where('brand_id', $request->brand_id)->where('measurement_id',$request->measurement_id)->first();

            if($product_weight){

            return back()->with('warning','Product weight already exists!');    

            }

                
            else{

                $product_weight = new ProductWeight;

                $product_weight->product_id = $request->product_id;
                $product_weight->brand_id = $request->brand_id;
                $product_weight->measurement_id = $request->measurement_id;
                $product_weight->price = $request->price;

                $product_weight->save();

            return back()->with('success','Product Unit added!');    

            }

           

            
        }

        public function weight_delete($id){

            $weight = ProductWeight::find($id);

            foreach($weight->cart as $cart){

                if($cart->order_id == NULL){

                    $cart->delete();
                }
            }

            $weight->delete();

            return back();
        }


        public function manage_units(){

            return view('backend.pages.products.manage_units');
        }

        public function unit_store(Request $request){

            $weight = new Measurement;
            $weight->weight = $request->weight;
            $weight->save();

            return back();

        }

        public function unit_delete($id){

            $weight = Measurement::find($id);
            foreach($weight->productweight as $stock){

                foreach($stock->cart as $cart){
                    if($cart->order_id == NULL){
                        $cart->delete();
                    }
                }
                $stock->delete();
            }
            $weight->delete();

            return back();
        }


        public function update_stock(Request $request,$id){

            $ProductWeight = ProductWeight::find($id);

            if($request->quantity || $request->quantity == 0){

            $ProductWeight->quantity = $request->quantity;

            }


            if($request->availability){

            $ProductWeight->availability = $request->availability;
                
            }

            else{

            $ProductWeight->availability = 0;    
                
            }
            



        $ProductWeight->save();

    return response()->json(['productweight' => $ProductWeight]);
        //return back();

        


    }    

}


