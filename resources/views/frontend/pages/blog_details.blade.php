@extends('frontend.layouts.app')
@section('content')
    <!-- Start About Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="banner-frame">@if($blog) @if($blog->image) <img class="img-fluid" src="{{URL::to($blog->image)}}" alt="" /> @endif @endif 
                    </div>
                </div>
                <div class="col-lg-6">
                    @if($blog && $blog->title && $blog->details)
                    <h2 class="noo-sh-title-top"><span>{{$blog->title}}</span></h2>
                    <p>{{$blog->details}}</p>
                    @endif
                </div>
            </div>
            
          
        </div>
    </div>
    <!-- End About Page -->
@endsection