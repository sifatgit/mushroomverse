@extends('frontend.layouts.app')
@section('content')
    <!-- Start Privacy Policy Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row d-flex justify-content-center">
				
                <div class="col-lg-6 ">
                    <h2 class="noo-sh-title-top d-flex justify-content-center"><span>Privacy Policy</span></h2>
                    @if($setting && $setting->privacy_policy)
                    <p>{{$setting->privacy_policy}}</p>
                    @endif
					
                </div>
            </div>
            
          
        </div>
    </div>
    <!-- End Privacy Policy Page -->
@endsection