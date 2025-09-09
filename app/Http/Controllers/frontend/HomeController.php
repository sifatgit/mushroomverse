<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Cart;

class HomeController extends Controller
{
    public function index(){


        session()->forget('randomtoken');

        return view('frontend.index');
    }
}
