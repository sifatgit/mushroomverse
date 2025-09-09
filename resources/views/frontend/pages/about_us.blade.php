@extends('frontend.layouts.app')
@section('content')
    <!-- Start About Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row">
				<div class="col-lg-6">
                    <div class="banner-frame"> @if($setting) @if($setting->about_us_image)<img class="img-fluid" src="{{URL::to($setting->about_us_image)}}" alt="" /> @endif @endif
                    </div>
                </div>
                <div class="col-lg-6">
                    <h2 class="noo-sh-title-top"><span>@if($setting) @if($setting->about_us_headline) {{$setting->about_us_headline}} @endif @endif</span></h2>
                    <p>@if($setting) @if($setting->about_us_description){{$setting->about_us_description}} @endif @endif</p>
					
                </div>
            </div>
            
          
        </div>
    </div>
    <!-- End About Page -->
@endsection