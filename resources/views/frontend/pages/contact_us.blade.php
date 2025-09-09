@extends('frontend.layouts.app')
@section('content')
    <!-- Start Contact Us  -->
    <div class="contact-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-sm-12">
                    <div class="contact-form-right">
                        @php 
                        $user_message = App\Models\Message::where('ip_address',request()->ip())->where('seen', 0)->exists(); 
                        $message_table = App\Models\Message::count();
                        @endphp
                        @if(!$user_message || $message_table === 0)
                        <h2>GET IN TOUCH</h2>
                        <form id="message_submit" action="{{route('message.store')}}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control"  name="name" placeholder="Your Name" required data-error="Please enter your name">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="email" placeholder="Your Email"  class="form-control" name="email" required data-error="Please enter your email">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <input type="text" class="form-control"  name="subject" placeholder="Subject" required data-error="Please enter your Subject">
                                        <div class="help-block with-errors"></div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <textarea class="form-control"  placeholder="Your Message" name="message" rows="4" data-error="Write your message" required></textarea>
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="submit-button text-center">
                                        <button class="btn hvr-hover"  type="submit">Send Message</button>
                                        <div id="msgSubmit" class="h3 text-center hidden"></div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @else
                        <h1>Please check your email inbox</h1>
                        @endif
                    </div>
                </div>
                <div class="col-lg-4 col-sm-12">
                    <div class="contact-info-left">
                        <h2>CONTACT INFO</h2>
                        @if($setting && $setting->contact_us_description)
                        <p>{{$setting->contact_us_description}}</p>
                        @endif
                        @if($setting && $setting->address && $setting->phone_no && $setting->email)
                        <ul>
                            <li>
                                <p><i class="fas fa-map-marker-alt"></i>Address: {{$setting->address}}</p>
                            </li>
                            <li>
                                <p><i class="fas fa-phone-square"></i>Phone: <a href="tel:{{$setting->phone_no}}">{{$setting->phone_no}}</a></p>
                            </li>
                            <li>
                                <p><i class="fas fa-envelope"></i>Email: <a href="mailto:{{$setting->email}}">{{$setting->email}}</a></p>
                            </li>
                        </ul>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="container">
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
    <!-- End Cart -->
@endsection
