<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class AdminBlogsController extends Controller
{
    public function store(Request $request){

      $validated = $request->validate([
          'title' => 'required',
          'details' => 'required|string',
          'image' => 'nullable',

      ]);


        $blog = new Blog;
        $blog->title = $request->title;
        $blog->details = $request->details;


        $image = $request->file('image');

        if($image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/blogs/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $blog->image=$image_url;

            
        }

        $blog->save();

        return back();
    }

        public function update(Request $request,$id){


      $validated = $request->validate([
          'title' => 'required',
          'details' => 'required|string',
          'image' => 'nullable',

      ]);


        $blog = Blog::find($id);
        $blog->title = $request->title;
        $blog->details = $request->details;


        $image = $request->file('image');
        $old_photo = $request->old_photo;

        if($image){

            $image_name=hexdec(uniqid());
            $ext=strtolower($image->getClientOriginalExtension());
            $image_full_name=$image_name.'.'.$ext;
            $upload_path='admin/images/blogs/';
            $image_url=$upload_path.$image_full_name;
            $success=$image->move($upload_path,$image_full_name);
            $blog->image=$image_url;


            if($old_photo){

                unlink($old_photo);
            }

            
        }

        $blog->save();

        return back();
    }


    public function delete($id){

        $blog = Blog::find($id);

        if($blog->image){

            unlink($blog->image);
        }

        $blog->delete();

        return back();
    }


}
