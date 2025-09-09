<!DOCTYPE html>
<html lang="en">
<!-- Basic -->

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Site Metas -->
    <title> @if($setting) @if($setting->title) {{$setting->title}} @else No title @endif @endif</title>
    <meta name="keywords" content="">
    <meta name="description" content="">
    <meta name="author" content="">

@include('frontend.partials.styles')

</head>

<body>
    <!-- Start Main Top -->
    <div class="main-top">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					
                    <div class="right-phone-box">
                        <p>Call US :- <i class="fas fa-phone"></i>@if($setting)  @if($setting->phone_no) <a href="tel:{{$setting->phone_no}}">{{$setting->phone_no}} @else no phone no @endif</a> @endif</p>
                    </div>
                    <div class="our-link">
                        <ul>
                            
                            <li><a href="{{route('orders')}}"><i class="fas fa-clipboard-list"></i> My Orders</a></li>
                            <li><a href="{{url('/location')}}"><i class="fas fa-location-arrow"></i> Our location</a></li>
                            <li><a href="{{url('/contact_us')}}"><i class="fas fa-headset"></i> Contact Us</a></li>
                            <li><a href="{{route('wishlist')}}"><i class="fas fa-heart"></i> My Wishlist</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12">
					
                    
                </div>
            </div>
        </div>
    </div>
    <!-- End Main Top -->

    <!-- Start Main Top -->
    <header class="main-header">
        <!-- Start Navigation -->
        <nav class="navbar navbar-expand-lg  navbar-default bootsnav" style="background-image: url('{{asset('public/frontend/asset/images/mushroomverse_web_bg3.png')}}'); background-size: cover; ">
            <div class="container">
                <!-- Start Header Navigation -->
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-menu" aria-controls="navbars-rs-food" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="fa fa-bars" style="color: white;"></i>
                </button>
                    <a class="navbar-brand" href="{{url('/')}}">@if($setting)  @if($setting->logo)<img src="{{URL::to($setting->logo)}}" style="width: 200px; height: 108px;" class="logo" alt=""> @else no logo @endif @endif</a>
                </div>
                <!-- End Header Navigation -->

                <!-- Collect the nav links, forms, and other content for toggling -->
                <div class="collapse navbar-collapse" id="navbar-menu">
                    <ul class="nav navbar-nav ml-auto" data-in="fadeInDown" data-out="fadeOutUp">
                        <li class="nav-item "><a class="nav-link" href="{{url('/')}}">Home</a></li>
                        <li class="nav-item">
                            <a class="nav-link" href="{{route('products')}}" class="nav-link">SHOP</a>
                        </li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/about_us')}}">About Us</a></li>
                        <li class="nav-item"><a class="nav-link" href="{{url('/contact_us')}}">Contact Us</a></li>
                    </ul>
                </div>
                <!-- /.navbar-collapse -->

                <!-- Start Atribute Navigation -->
                <div class="attr-nav">
                    <ul>
                        <li class="search"><a href="#"><i class="fa fa-search"></i></a></li>
                        <li class="side-menu">
							<a href="#">
								<i class="fa fa-shopping-bag"></i>
                                
                                @php $total_carts = $carts;  @endphp
								<span class="badge">{{count($total_carts)}}</span>
								<p>My Cart</p>
							</a>
						</li>
                    </ul>
                </div>
                <!-- End Atribute Navigation -->
            </div>
            <!-- Start Side Menu -->
            <div class="side">
                <a href="#" class="close-side"><i class="fa fa-times"></i></a>
                <li class="cart-box">
                   
                    <ul class="cart-list">
                        @php $total_price = 0 @endphp
                        @foreach($carts as $cart)
                        <li>
                            @php $total_price+= $cart->product_price * $cart->product_quantity; @endphp
                            @php $image = $cart->product_image @endphp
                            <a href="#" class="photo"><img src="{{URL::to($image)}}" class="cart-thumb" alt="" /></a>
                            <h6><a href="#">{{$cart->product_title}} </a></h6>
                            <p>{{$cart->product_quantity}}x - <span class="price">Tk {{$cart->product_price}}</span></p>
                        </li>
                        @endforeach
                        <input id="prev_total_price" type="hidden" name="prev_toal_price" value="{{$total_price ?? 0}}">
                        <li class="total">
                            <a href="{{route('carts')}}" class="btn btn-default hvr-hover btn-cart">VIEW CART</a>
                            <span class="float-right"><strong>Total</strong>: Tk {{$total_price}}</span>
                        </li>
                    </ul>
                </li>
            </div>
            <!-- End Side Menu -->
        </nav>
        <!-- End Navigation -->
    </header>
    <!-- End Main Top -->

    <!-- Start Top Search -->
    <div class="top-search">
        <div class="container">
            <div class="input-group">
                <span class="input-group-addon"><i style="cursor: pointer;" id="search_fa" class="fa fa-search"></i></span>
                <input id="button1" type="text" class="form-control" placeholder="Search">
                <span class="input-group-addon close-search"><i class="fa fa-times"></i></span>

                <form id="search_form" style="display: none;" action="{{route('product.search')}}" method="GET" enctype="multipart/form-data">
                <input id="button2" type="hidden" name="search"> 
                    <button type="submit">Search</button>
                </form>

            </div>
            
        </div>
    <!-- Product Results -->
    <div id="product_results" style="display: none;" class="container mt-3">
        <ul class="d-flex list-unstyled overflow-auto gap-3 p-0">
            <!-- Product 1 -->
            <li id="product-item1" class="text-center p-3 text-white" style="min-width: 200px; display: none;">
                <a id="product1_link" href="#" class="text-decoration-none">
                <img id="product1_image" src="https://via.placeholder.com/150" alt="Product 1" class="img-fluid rounded mb-2" style="width: 60px; height: 60px;">
                <h5 id="product1_title" class="mb-1 text-white">Product 1</h5>
                <p id="product1_price" class="fw-bold mb-2 text-white">$29.99</p>
                <button class="btn btn-sm text-white" style="background-color: #0a434d;">View Details</button>
                </a>
            </li>
            <!-- Product 2 -->
            <li id="product-item2" class="text-center p-3 text-white" style="min-width: 200px; display: none;">
                <a id="product2_link" href="#" class="text-decoration-none">
                <img id="product2_image" src="https://via.placeholder.com/150" alt="Product 2" class="img-fluid rounded mb-2" style="width: 60px; height: 60px;">
                <h5 id="product2_title" class="mb-1 text-white">Product 2</h5>
                <p id="product2_price" class="fw-bold mb-2 text-white">$39.99</p>
                <button class="btn btn-sm text-white" style="background-color: #0a434d;">View Details</button>
                </a>
            </li>
            <!-- Product 3 -->
            <li id="product-item3" class="text-center p-3 text-white" style="min-width: 200px; display: none;">
                <a id="product3_link" href="#" class="text-decoration-none">
                <img id="product3_image" src="https://via.placeholder.com/150" alt="Product 3" class="img-fluid rounded mb-2" style="width: 60px; height: 60px;">
                <h5 id="product3_title" class="mb-1 text-white">Product 3</h5>
                <p id="product3_price" class="fw-bold mb-2 text-white">$19.99</p>
                <button class="btn btn-sm text-white" style="background-color: #0a434d;">View Details</button>
                </a>
            </li>
            <!-- Product 4 -->
            <li id="product-item4" class="text-center p-3 text-white" style="min-width: 200px; display: none;">
                <a id="product4_link" href="#" class="text-decoration-none">
                <img id="product4_image" src="https://via.placeholder.com/150" alt="Product 4" class="img-fluid rounded mb-2" style="width: 60px; height: 60px;">
                <h5 id="product4_title" class="mb-1 text-white">Product 4</h5>
                <p id="product4_price" class="fw-bold mb-2 text-white">$49.99</p>
                <button class="btn btn-sm text-white" style="background-color: #0a434d;">View Details</button>
                </a>
            </li>
            <!-- Product 5 -->
            <li id="product-item5" class="text-center p-3 text-white" style="min-width: 200px; display: none;">
                <a id="product5_link" href="#" class="text-decoration-none">
                <img id="product5_image" src="https://via.placeholder.com/150" alt="Product 5" class="img-fluid rounded mb-2" style="width: 60px; height: 60px;">
                <h5 id="product5_title" class="mb-1 text-white">Product 5</h5>
                <p id="product5_price" class="fw-bold mb-2 text-white">$49.99</p>
                <button class="btn btn-sm text-white" style="background-color: #0a434d;">View Details</button>
                </a>
            </li>
            <!--view all-->            
            <li id="product-item6" class="text-center p-3" style="min-width: 200px; display: none;">
                <p id="product6_price" class="fw-bold mb-2"><a id="product_link" class="text-white" href="#">View all</a></p>
                
            </li>            
        </ul>
    </div>        
    </div>
    <!-- End Top Search -->


    @yield('content')

    <!-- Start Footer  -->
    <footer>
        <div class="footer-main">
            <div class="container">
				<div class="row">                
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link">
                            <h4>Information</h4>
                            <ul>
                                <li><a href="{{url('/about_us')}}">About Us</a></li>
                                
                                
                                <li><a href="{{url('/terms_condition')}}">Terms &amp; Conditions</a></li>
                                <li><a href="{{url('/privacy_policy')}}">Privacy Policy</a></li>
                                <li><a href="{{url('/delivery_information')}}">Delivery Information</a></li>
                            </ul>
                        </div>
                    </div>                   
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-link-contact">
                            <h4>Contact Us</h4>
                            <ul>
                                <li>
                                    <p><i class="fas fa-map-marker-alt"></i>@if($setting)  @if($setting->address) {{$setting->address}} @else no address @endif @endif</p>
                                </li>
                                <li>
                                    <p><i class="fas fa-phone-square"></i>Phone: @if($setting)  @if($setting->phone_no)<a href="tel:{{$setting->phone_no}}"> {{$setting->phone_no}} </a> @else no phone no @endif</p>@endif
                                </li>
                                <li>
                                    <p><i class="fas fa-envelope"></i>Email: @if($setting)  @if($setting->email) <a href="mailto:{{$setting->email}}">{{$setting->email}} </a> @else no email @endif </p> @endif
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-12 col-sm-12">
                        <div class="footer-top-box">
                            <h3>Social Media</h3>
                            <p>You can always stay connected via these medias.</p>
                            <ul>
                                <li>@if($setting)  @if($setting->facebook_address)<a href="{{$setting->facebook_address}}">@else <a href="#"> @endif @endif<i class="fab fa-facebook" aria-hidden="true"></i></a></li>
                                <li>@if($setting)  @if($setting->instagram_address)<a href="{{$setting->instagram_address}}">@else <a href="#"> @endif @endif<i class="fab fa-instagram" aria-hidden="true"></i></a></li>                                
                                <li>@if($setting) @if($setting->email)<a href="{{$setting->email}}"> @else <a href="#"> @endif @endif<i class="fab fa-google" aria-hidden="true"></i></a></li>                              
                                <li>@if($setting)  @if($setting->whatsapp_address)<a href="{{$setting->whatsapp_address}}"> @else <a href="#"> @endif @endif<i class="fab fa-whatsapp" aria-hidden="true"></i></a></li>
                            </ul>
                        </div>
                    </div>                     
                </div>
            </div>
        </div>
    </footer>
    <!-- End Footer  -->

    <!-- Start copyright  -->
    <div class="footer-copyright">
        <p class="footer-company">All Rights Reserved. &copy; 2018 <a href="#">ThewayShop</a> Design By :
            <a href="https://html.design/">html design</a></p>
    </div>
    <!-- End copyright  -->

    <a href="#" id="back-to-top" title="Back to top" style="display: none;">&uarr;</a>

@include('frontend.partials.scripts')
</body>

</html>