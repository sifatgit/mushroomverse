@extends('frontend.layouts.app')
@section('content')
    <!-- Start Privacy Policy Page  -->
    <div class="about-box-main">
        <div class="container">
            <div class="row d-flex justify-content-center">
				
    <div class="row justify-content-center">
        <div class="col-lg-8 col-sm-12 d-flex justify-content-center">
            <div class="contact-form-center text-center">
                <h2>Google Map Location</h2>
                
                <!-- Google Map Embed -->
                @if($setting && $setting->google_map_link)
                <iframe
                    src="{{$setting->google_map_link}}" 
                    width="800" 
                    height="650" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                @else
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3746527.4526794753!2d90.3443647!3d23.506657!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x30adaaed80e18ba7%3A0xf2d28e0c4e1fc6b!2sBangladesh!5e0!3m2!1sen!2sbd!4v1735853369020!5m2!1sen!2sbd" 
                    width="800" 
                    height="650" 
                    style="border:0;" 
                    allowfullscreen="" 
                    loading="lazy" 
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
                @endif
            </div>
        </div>
    </div>
            </div>
            
          
        </div>
    </div>
    <!-- End Privacy Policy Page -->
@endsection