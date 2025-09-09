@extends('frontend.layouts.app')
@section('content')
    <!-- Start Privacy Policy Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row d-flex justify-content-center">
				
                <div class="col-lg-6 ">
                    <h2 class="noo-sh-title-top d-flex justify-content-center"><span>Terms & Conditions</span></h2>
                    @if($setting && $setting->terms_conditions)
                    <p>{{$setting->terms_conditions}}</p>
                    @endif
					
                </div>
            </div>
            
          
        </div>
    </div>
    <!-- End Privacy Policy Page -->
@endsection