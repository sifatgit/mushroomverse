<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Brand;

class AdminBrandsController extends Controller
{
public function store(Request $request){

      $validated = $request->validate([

          'name' => 'required|string',
          'description' => 'required|string',
          'logo' => 'nullable',

      ]);

        $brand = new Brand;

        $brand->name = $request->name;
        $brand->description = $request->description;

        $logo = $request->file('logo');

        if($logo){

            $logo_name=hexdec(uniqid());
            $ext=strtolower($logo->getClientOriginalExtension());
            $logo_full_name=$logo_name.'.'.$ext;
            $upload_path='admin/logos/brands/';
            $logo_url=$upload_path.$logo_full_name;
            $success=$logo->move($upload_path,$logo_full_name);
            $brand->logo=$logo_url;

            
        }

        $brand->save();


        return redirect()->route('admin.brands');
    }

    public function update(Request $request,$id){

      $validated = $request->validate([

          'name' => 'required|string',
          'description' => 'required|string',
          'logo' => 'nullable',

      ]);
      
        $brand = Brand::find($id);

        $brand->name = $request->name;
        $brand->description = $request->description;

        $old_logo = $request->old_logo;

        $logo = $request->file('logo');

        if($logo){

            $logo_name=hexdec(uniqid());
            $ext=strtolower($logo->getClientOriginalExtension());
            $logo_full_name=$logo_name.'.'.$ext;
            $upload_path='admin/logos/brands/';
            $logo_url=$upload_path.$logo_full_name;
            $success=$logo->move($upload_path,$logo_full_name);
            $brand->logo=$logo_url;

            if($old_logo){

                unlink($old_logo);

            }

        }

        $brand->save();


        return redirect()->route('admin.brands');

    }

    public function delete($id){

            $brand = Brand::find($id);

            if($brand->logo){

                unlink($brand->logo);
            }

            foreach($brand->products as $product){

                if(!is_null($product->images)){

                    $images = explode("|",$product->images);
                    foreach($images as $image){
                        unlink($image);
                    }
                }

                foreach($product->productweight as $wgt){

                    foreach($wgt->cart as $cart){

                        if($cart->order_id == NULL){
                            $cart->delete();
                        }
                    }

                    $wgt->delete();
                }

                $product->delete();
            }

            $brand->delete();
            
            return back();

    }
}
