<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;

class AdminSlidersController extends Controller
{
    public function store(Request $request){

        $validated = $request->validate([

            'title' => 'required|string',
            'text' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png',
        

        ]);


        $sliders = Slider::get();

        if(count($sliders) > 2) {

        return back()->with('warning','Max 3 slider images allowed!');  
          
        }

        else{

        $slider = new Slider;

        $slider->title = $request->title;
        $slider->text = $request->text;

        $image = $request->file('image');

        if($image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/sliders/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $slider->image=$image_url;

            
        }

        $slider->save();

        return back()->with('success', 'Slider stored successfully!');    

        }



    }

    public function delete($id){

        $slider = Slider::find($id);
        
        if($slider->image){

            unlink($slider->image);
        }

        $slider->delete();

        return back();
    }
}
