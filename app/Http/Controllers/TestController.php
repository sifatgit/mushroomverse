<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;

class TestController extends Controller
{
    public function store(Request $request){
        
        //Category store ORM


            $validated = $request->validate([

            'image' => 'required|mimes:jpeg,png,jpg,gif',
            'name' => 'required|max:25|unique:categories',
            'description' => 'required|max:255|min:10',

        ]);

        $category = new Category;

        $category->name = $request->name;
        $category->description = $request->description;

        $image = $request->file('image');

        if($image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='public/admin/images/categories/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $category->image=$image_url;

            
        }

        $category->save();



        return redirect()->route('admin.categories')->with('success','Category has been added Successfully!');
        

        //Category store ORM end

        
        //Brand Store ORM end

        else{

            return back()->with('error','Operation could not be completed!');
        }

        



    }
}
