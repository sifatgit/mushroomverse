<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Brand;
use App\Models\Product;
use App\Models\Order;
use App\Models\Division;
use App\Models\District;
use App\Models\Slider;
use App\Models\Blog;
use App\Models\Notification;
use App\Models\Message;

class AdminController extends Controller
{
    public function categories(){

        $data = Category::all();

        return view('backend.pages.categories.index', compact('data'));
    }


    public function brands(){

        $data = Brand::all();

        return view('backend.pages.brands.index', compact('data'));
    }


    public function products(){

        $data = Product::all();

        return view('backend.pages.products.index', compact('data'));
    }

    public function orders(){

        $data = Order::all();

        return view('backend.pages.orders.index',compact('data'));
    }

    public function divisions(){

        $data = Division::all();

        return view('backend.pages.divisions.index',compact('data'));
    }

    public function districts(){

        $data = District::all();

        return view('backend.pages.districts.index',compact('data'));
    }

    public function sliders(){

        $data = Slider::all();

        return view('backend.pages.sliders.index',compact('data'));
    }    
    public function blogs(){

        $data = Blog::all();

        return view('backend.pages.blogs.index',compact('data'));
    }    

    public function notifications(){

        $data = Notification::all();

        return view('backend.pages.notifications.index',compact('data'));
    }

    public function messages(){

        $data = Message::all();

        return view('backend.pages.messages.index',compact('data')); 
    }    



}
