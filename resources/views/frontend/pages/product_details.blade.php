@extends('frontend.layouts.app')
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Product Details</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('products')}}">Shop</a></li>
                        <li class="breadcrumb-item active">Shop Detail </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Detail  -->
    <div class="shop-detail-box-main">
        <div class="container">
            <div class="row">
                <div class="col-xl-5 col-lg-5 col-md-6">
                    <div id="carousel-example-1" class="single-product-slider carousel slide" data-ride="carousel">
                        <div class="carousel-inner" role="listbox">
                            @php $image = explode("|",$product->images);
                            
                            @endphp
                            @php $wishlist = App\Models\Wishlist::where('product_id',$product->id)->where('ip_address',request()->ip())->first(); @endphp                           
                            @foreach($image as $img)
                            <div class="carousel-item {{ $loop->first ? 'active' : '' }}"> <img class="d-block w-100" src="{{URL::to($img)}}" alt="First slide"> </div>
                            @endforeach
                            
                        </div>
                        <a class="carousel-control-prev" href="#carousel-example-1" role="button" data-slide="prev"> 
                        <i class="fa fa-angle-left" aria-hidden="true"></i>
                        <span class="sr-only">Previous</span> 
                    </a>
                        <a class="carousel-control-next" href="#carousel-example-1" role="button" data-slide="next"> 
                        <i class="fa fa-angle-right" aria-hidden="true"></i> 
                        <span class="sr-only">Next</span> 
                    </a>
                        <!-- Dynamic Carousel Indicators -->
                        <ol class="carousel-indicators">
                            @foreach($image as $index => $img)
                                <li data-target="#carousel-example-1" data-slide-to="{{ $index }}" class="{{ $loop->first ? 'active' : '' }}">
                                    <img class="d-block w-100 img-fluid" src="{{ URL::to($img) }}" alt="Thumbnail {{ $index + 1 }}" />
                                </li>
                            @endforeach
                        </ol>
                    </div>
                </div>
                <div class="col-xl-7 col-lg-7 col-md-6">
                    @if($product->category->type == 2)
                    <div class="single-product-details">
                        <h2>{{$product->title}}</h2>
                        <h5 class="product-price"> <!--<del>$ 60.00</del>-->Tk {{$product->price}}</h5>
                        @php $quantity = 0 @endphp 
                        @foreach($product->productweight as $qty)
                        @php $quantity+= $qty->quantity; @endphp
                        @endforeach
                        @php $sold = 0 @endphp
                        @foreach($product->cart()->where('order_id','!=',Null) as $ordered)
                        @php $sold += $ordered->product_quantity @endphp
                        @endforeach
                        <p>@if($quantity > 0)<span class="btn btn-success" id="available-stock" >{{$quantity}} available</span>@else <span class="btn btn-warning" id="available-stock" >currently unavailable</span> @endif</p>
                        <h4>Short Description:</h4>
                        <p>{{$product->description}}</p>
                        <ul>
                            <li>
                                <div class="form-group quantity-box">
                                    
                                    <label class="control-label">Quantity</label>
                                    <input id="qty" class="form-control" value="1" min="1" max="{{$quantity}}" type="number">

                                </div>
                                <div class="form-group">    
                                <label class="control-label">Weight</label>
                                
                                    <select style="background-color: #1B4B4C;" class="btn text-light" id="weight_dropdown" name="measurement_id" required>
                                    <option style="background-color: #1B4B4C;" class="text-center text-white" value="">Select a weight</option>
                                    @foreach($product->productweight as $wgt)

                                    @if($wgt->quantity > 0)
                                    <option style="background-color: #1B4B4C;" class="text-center text-light" data-id="{{$wgt->id}}" value="{{$wgt->measurement->id}}">{{$wgt->measurement->weight}} g</option>                                  
                                    @endif
                                    @endforeach
                                    </select>

                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn" style="display: flex; gap: 15px; align-items: center;">
                                <form action="{{route('single_product.checkout')}}" method="GET" enctype="multipart/form-data" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="product_title" value="{{$product->title}}">
                                    <input type="hidden" name="weight_id" value="" id="weight_id">
                                    <input id="product_qty" type="hidden" name="quantity" value="1">
                                    <input id="amount" type="hidden" name="amount" value="{{$product->price}}">
                                    <button disabled id="buy_now" style="width: 96px; height: 44px; margin: 0; padding: 0;" class="btn hvr-hover text-light" data-fancybox-close="" >Buy Now</button>
                                </form>

                                <form class="form-group cartstore" action="{{ route('cart.store') }}" method="POST" style="margin: 0;">  
                                    @csrf  
                                    <input id="product_id" type="hidden" name="product_id" value="{{ $product->id }}" required>
                                    <input id="measurement_id" type="hidden" name="measurement_id" value="" required>                                  
                                    <input id="productweight_id" type="hidden" name="productweight_id">
                                    @if($product->brand_id)
                                        <input id="brand_id" type="hidden" name="brand_id" value="{{ $product->brand->id }}" required>
                                    @endif
                                    <input id="product_quantity" type="hidden" name="product_quantity" value="" required>
                                    <button style="width: 96px; height: 44px; margin: 0; padding: 0;" id="cart-button" class="btn hvr-hover text-light" data-fancybox-close="" href="#" disabled>Add to Cart</button>    
                                </form>
                                
                            </div>
                        </div>

                        <div class="add-to-btn">
                            <div class="add-comp">
                                @if($wishlist)
                                <a class="btn hvr-hover addtowish2" href="{{route('wishlist.store',$product->id)}}"><i class="fas fa-heart"></i> Added to wishlist</a>
                                @else
                                <a class="btn hvr-hover addtowish2" href="{{route('wishlist.store',$product->id)}}"><i class="fas fa-heart"></i> Add to wishlist</a>                                
                                @endif
                                
                            </div>
                            <div class="share-bar">
                                @if($setting && $setting->facebook_address))
                                <a class="btn hvr-hover" href="{{$setting->facebook_address}}"><i class="fab fa-facebook" aria-hidden="true"></i></a>                                
                                @endif
                                @if($setting && $setting->instagram_address)
                                <a class="btn hvr-hover" href="{{$setting->instagram_address}}"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                @endif
                                @if($setting && $setting->googleplus_address)
                                <a class="btn hvr-hover" href="{{$setting->googleplus_address}}"><i class="fab fa-google-plus" aria-hidden="true"></i></a>                                
                                @endif
                                @if($setting && $setting->twitter_address)
                                <a class="btn hvr-hover" href="{{$setting->twitter_address}}"><i class="fab fa-twitter" aria-hidden="true"></i></a>                             
                                @endif
                                @if($setting && $setting->pinterest_address)
                                <a class="btn hvr-hover" href="{{$setting->pinterest_address}}"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                @endif
                                @if($setting && $setting->whatsapp_address)
                                <a class="btn hvr-hover" href="{{$setting->whatsapp_address}}"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                    @else
                    <div class="single-product-details">
                        <h2 >{{$product->title}}</h2>
                        <h5 class="product-price" > <!--<del>$ 60.00</del>-->Tk {{$product->price}}</h5>
                        @php $availability = $product->productweight()->where('availability',1)->get(); @endphp
                        <p>@if(count($availability) > 0)<span class="btn btn-success" id="available-stock"> Available </span> @else <span class="btn btn-warning" id="available-stock"> currently unavailable </span> @endif</p>
                        <h4>Short Description:</h4>
                        <p>{{$product->description}}</p>
                        <ul>
                            <li>
                                <div class="form-group quantity-box">
                                    
                                    <label class="control-label">Quantity</label>
                                    <input id="qty" class="form-control" value="1" min="1" max="" type="number">

                                </div>
                                <div class="form-group">    
                                <label class="control-label">Weight</label>
                                
                                    <select style="background-color: #1B4B4C;" class="btn text-light" id="weight_dropdown" name="measurement_id" required>
                                    <option class="text-center text-light" value="">Select a weight</option>
                                    @foreach($product->productweight as $wgt)

                                    @if($wgt->availability == 1)
                                    <option class="text-center text-light" data-id="{{$wgt->id}}" value="{{$wgt->measurement->id}}">{{$wgt->measurement->weight}} g</option>                                  
                                    @endif
                                    @endforeach
                                    </select>

                                </div>
                            </li>
                        </ul>

                        <div class="price-box-bar">
                            <div class="cart-and-bay-btn" style="display: flex; gap: 15px; align-items: center;">
                                <form action="{{route('single_product.checkout')}}" method="GET" enctype="multipart/form-data" style="margin: 0;">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{$product->id}}">
                                    <input type="hidden" name="product_title" value="{{$product->title}}">
                                    <input type="hidden" name="weight_id" value="" id="weight_id">
                                    <input id="product_qty" type="hidden" name="quantity" value="1">
                                    <input id="amount" type="hidden" name="amount" value="{{$product->price}}">
                                    <button disabled id="buy_now" style="width: 96px; height: 44px; margin: 0; padding: 0;" class="btn hvr-hover text-light" data-fancybox-close="" >Buy Now</button>
                                </form>

                                <form class="form-group cartstore" action="{{ route('cart.store') }}" method="POST" style="margin: 0;">  
                                    @csrf  
                                    <input id="product_id" type="hidden" name="product_id" value="{{ $product->id }}" required>
                                    <input id="measurement_id" type="hidden" name="measurement_id" value="" required>
                                    <input id="productweight_id" type="hidden" name="productweight_id">
                                    @if($product->brand_id)
                                        <input id="brand_id" type="hidden" name="brand_id" value="{{ $product->brand->id }}" required>
                                    @endif
                                    <input id="product_quantity" type="hidden" name="product_quantity" value="" required>
                                    <button style="width: 96px; height: 44px; margin: 0; padding: 0;" id="cart-button" class="btn hvr-hover text-light" data-fancybox-close="" href="#" disabled>Add to Cart</button>    
                                </form>
                            </div>
                        </div>



                        <div class="add-to-btn">
                            <div class="add-comp">
                                @if($wishlist)
                                <a class="btn hvr-hover addtowish2" href="{{route('wishlist.store',$product->id)}}"><i class="fas fa-heart"></i> Added to wishlist</a>
                                @else
                                <a class="btn hvr-hover addtowish2" href="{{route('wishlist.store',$product->id)}}"><i class="fas fa-heart"></i> Add to wishlist</a>                                
                                @endif
                            
                            </div>
                            <div class="share-bar">
                                
                                @if($setting && $setting->facebook_address))
                                <a class="btn hvr-hover" href="{{$setting->facebook_address}}"><i class="fab fa-facebook" aria-hidden="true"></i></a>                                
                                @endif
                                @if($setting && $setting->instagram_address)
                                <a class="btn hvr-hover" href="{{$setting->instagram_address}}"><i class="fab fa-instagram" aria-hidden="true"></i></a>
                                @endif
                                @if($setting && $setting->googleplus_address)
                                <a class="btn hvr-hover" href="{{$setting->googleplus_address}}"><i class="fab fa-google-plus" aria-hidden="true"></i></a>                                
                                @endif
                                @if($setting && $setting->twitter_address)
                                <a class="btn hvr-hover" href="{{$setting->twitter_address}}"><i class="fab fa-twitter" aria-hidden="true"></i></a>                             
                                @endif
                                @if($setting && $setting->pinterest_address)
                                <a class="btn hvr-hover" href="{{$setting->pinterest_address}}"><i class="fab fa-pinterest-p" aria-hidden="true"></i></a>
                                @endif
                                @if($setting && $setting->whatsapp_address)
                                <a class="btn hvr-hover" href="{{$setting->whatsapp_address}}"><i class="fab fa-whatsapp" aria-hidden="true"></i></a>
                                @endif
                                
                            </div>
                        </div>
                    </div>                    
                    @endif
                </div>
            </div>
            
            <!--<div class="row my-5">
                <div class="card card-outline-secondary my-4">
                    <div class="card-header">
                        <h2>Product Reviews</h2>
                    </div>
                    <div class="card-body">
                        <div class="media mb-3">
                            <div class="mr-2"> 
                                <img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                            </div>
                            <div class="media-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                                <small class="text-muted">Posted by Anonymous on 3/1/18</small>
                            </div>
                        </div>
                        <hr>
                        <div class="media mb-3">
                            <div class="mr-2"> 
                                <img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                            </div>
                            <div class="media-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                                <small class="text-muted">Posted by Anonymous on 3/1/18</small>
                            </div>
                        </div>
                        <hr>
                        <div class="media mb-3">
                            <div class="mr-2"> 
                                <img class="rounded-circle border p-1" src="data:image/svg+xml;charset=UTF-8,%3Csvg%20width%3D%2264%22%20height%3D%2264%22%20xmlns%3D%22http%3A%2F%2Fwww.w3.org%2F2000%2Fsvg%22%20viewBox%3D%220%200%2064%2064%22%20preserveAspectRatio%3D%22none%22%3E%3Cdefs%3E%3Cstyle%20type%3D%22text%2Fcss%22%3E%23holder_160c142c97c%20text%20%7B%20fill%3Argba(255%2C255%2C255%2C.75)%3Bfont-weight%3Anormal%3Bfont-family%3AHelvetica%2C%20monospace%3Bfont-size%3A10pt%20%7D%20%3C%2Fstyle%3E%3C%2Fdefs%3E%3Cg%20id%3D%22holder_160c142c97c%22%3E%3Crect%20width%3D%2264%22%20height%3D%2264%22%20fill%3D%22%23777%22%3E%3C%2Frect%3E%3Cg%3E%3Ctext%20x%3D%2213.5546875%22%20y%3D%2236.5%22%3E64x64%3C%2Ftext%3E%3C%2Fg%3E%3C%2Fg%3E%3C%2Fsvg%3E" alt="Generic placeholder image">
                            </div>
                            <div class="media-body">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Omnis et enim aperiam inventore, similique necessitatibus neque non! Doloribus, modi sapiente laboriosam aperiam fugiat laborum. Sequi mollitia, necessitatibus quae sint natus.</p>
                                <small class="text-muted">Posted by Anonymous on 3/1/18</small>
                            </div>
                        </div>
                        <hr>
                        <a href="#" class="btn hvr-hover">Leave a Review</a>
                    </div>
                  </div>
            </div>-->

            

        </div>
    </div>
    <!-- End Cart -->

@endsection