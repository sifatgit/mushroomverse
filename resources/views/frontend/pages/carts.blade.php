@extends('frontend.layouts.app')
@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Cart</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{URL::to('/products')}}">Shop</a></li>
                        <li class="breadcrumb-item active">Cart</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                        <table class="table">
                            <thead>

                                @if(count($carts) > 0)
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Weight</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Total</th>
                                    <th>Remove</th>
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                 
                                @php $sub_total = 0; @endphp

                                @php  @endphp

                                @if(count($carts) > 0)
                                @foreach($carts as $cart)

                                <tr class="remove-pr-{{$cart->id}}">
                                    <td class="thumbnail-img">
                                        <a href="#">
                                            @php $image = $cart->product_image; @endphp
                                            @if($image)
									<img class="img-fluid" src="{{URL::to($image)}}" alt="" />
                                            @else
                                    <img class="img-fluid" src="{{asset('public/admin/images/icons/default-image_550.png')}}" alt="" />
                                            @endif
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									{{$cart->product_title}}
								</a>
                                    </td>
                                    <td class="name-pr">
                                    @if($cart->brand_name != NULL)    
                                    {{$cart->brand_name}}
                                    @else
                                    N/A
                                    @endif
                                    </td>
                                    <td class="name-pr">    
                                    {{$cart->measurement_weight}}
                                
                                    </td>
                                    <td class="price-pr">
                                        <p>Tk {{$cart->product_price}}</p>
                                    </td>
                                    <td class="quantity-box">
                                    <form data-id="{{$cart->id}}" class="cartupdate" action="{{route('cart.update',$cart->id)}}" method="POST" enctype="multipart/form-data">
                                    @csrf

                                    @if($cart->category_type == 2)
                                    @php $maximum = $cart->productweight;
                                    $maximum_quantity = $maximum->quantity;
                                    @endphp

                                    @else

                                    @php $maximum_quantity = PHP_INT_MAX; @endphp

                                    @endif

                                    <input class="maximum_quantity" type="number" size="4" value="{{$cart->product_quantity}}" min="1" max="{{$maximum_quantity}}" step="1" name="product_quantity">
                                    <button class="btn btn-success" type="submit">Update</button>
                                    </form></td>
                                    @php $total_price = $cart->product_price*$cart->product_quantity; @endphp
                                    <td class="total-pr">
                                        <p>Tk {{$total_price}}</p>
                                        @php $sub_total+= $total_price; @endphp
                                    </td>
                                    <td>
                                        <a class="remove_link" data-id="{{$cart->id}}" href="#" >
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                @endforeach

                                @else
                                <tr><td><h1>You have nothing on your cart!</h1></td></tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                    @if(count($carts) > 0)                    
                    <div class="coupon-box">
                        <div class="input-group input-group-sm">
                            <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
                            <div class="input-group-append">


                                <button class="btn btn-theme" type="button">Apply Coupon</button>
                                
                            </div>
                        </div>
                    </div>
                    @endif
                </div>
                
            </div>
            @if(count($carts) > 0)

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            
                            <div class="ml-auto font-weight-bold">{{$sub_total}} ৳ </div>
                        </div>
                        
                        <hr class="my-1">
                        
                        
                        
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            @php $grand_total =  $sub_total @endphp
                            <div class="ml-auto h5">{{$grand_total}} ৳ </div>
                        </div>
                        <hr> </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="{{route('checkouts')}}" class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>
            @endif
        </div>
    </div>
    <!-- End Cart -->

@endsection    