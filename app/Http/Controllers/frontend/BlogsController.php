<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;

class BlogsController extends Controller
{
    public function view($id){

        $blog = Blog::find($id);

        return view('frontend.pages.blog_details',compact('blog'));
    }
}
