<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class AdminCategoriesController extends Controller
{
    public function store(Request $request){

    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'description' => 'required|string|max:2000',
        'image' => 'required|image|mimes:jpeg,jpg,png',
        'type' => 'required|integer|in:1,2,3', // adjust allowed values
    ]);


        $category = new Category;

        $category->name = $request->name;
        $category->description = $request->description;

        $image = $request->file('image');

        if($image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/categories/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $category->image=$image_url;

            
        }
        $category->type = $request->type;

        $category->save();


        return redirect()->route('admin.category');
    }

    public function update(Request $request,$id){


      $validated = $request->validate([

          'name' => 'required|string',
          'description' => 'required|string',
          'image' => 'required|mimes:jpeg,png',
          'type' => 'required|integer',

      ]);


        $category = Category::find($id);

        $category->name = $request->name;
        $category->description = $request->description;

        $old_photo = $request->old_photo;

        $image = $request->file('image');

        if($image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/categories/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $category->image=$image_url;

            if($old_photo){

                unlink($old_photo);

            }

        }

        $category->save();


        return redirect()->route('admin.category');

    }

    public function delete($id){

            $category = Category::find($id);

            if($category->image){

                unlink($category->image);
            }
            foreach($category->products as $product){

                if($product->images){

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

            $category->delete();
            
            return back();

    }
}
