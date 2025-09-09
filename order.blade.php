@extends('frontend.layouts.app')
@section('content')
    <!-- Start Cart  -->
    <div class="cart-box-main">
        <div class="container">
        	<h1>My orders</h1>
            @if(count(App\Models\Order::orders()) > 0)
        	@foreach(App\Models\Order:orders() as $order)
            <div class="row" >

                <div class="col-lg-12" >
                    <div class="table-main table-responsive" style="border: 2px solid black;">

                        <table class="table" >
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Brand</th>
                                    <th>Weight(g)</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                    <th>Total</th>
                                    <th>Remove</th>

                                </tr>
                            </thead>
                            <tbody>
                            	
                            	@foreach($order->carts as $cart)

                            	@php $image = $cart->product_image @endphp
                                <tr>
                                    <td class="thumbnail-img">
                                        <a href="#">
                                            @if($image)
									<img class="img-fluid" src="{{URL::to($image)}}" alt="" />
								</a>
                                    </td>
                                    <td class="name-pr">
                                        <a href="#">
									{{$cart->product_title}}
								</a>
                                    </td>
                                    <td class="price-pr">
                                    	@if($cart->brand_id)
                                        <p>{{$cart->brand_name}}</p>
                                        @else
                                        <p>N/A</p>
                                        @endif
                                    </td>
                                    <td class="weight">
                                        <p>{{$cart->measurement_weight}}</p>
                                    </td>
                                    <td class="quantity">
                                        <p>{{$cart->product_quantity}}</p>
                                    </td>
                                    <td class="price-pr">
                                        <p>{{$cart->product_price}}</p>
                                    </td>
                                    <td class="price-pr">
                                    	
                                        <p>{{$cart->product_price*$cart->product_quantity}}</p>
                                        
                                    </td>
                                    <td class="remove-pr">
                                        <a href="#">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                
                                
                                @endforeach
                                <tr>
                                	<td >Invoice No. {{$order->invoice_no}}</td>
                                	<td></td>
                                	<td></td>
                                	<td></td>
                                	<td></td>
                                	<td></td>
                                	<td><h3 valign="center">Total Price: {{$order->amount}} ৳</h3></td>
                                	<td></td>
                                </tr>
                                <tr>
                                	<td>Invoice Date: {{ $order->created_at->format('F j, Y g:i A') }}</td>
                                	<td></td>
                                	<td></td>
                                	<td></td>
                                	<td></td>
                                	<td></td>
                                	<td></td>
                                	<td></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div><br>	
            @endforeach
            @endif
            <div class="row my-5">
                <div class="col-lg-6 col-sm-6">
                    <div class="coupon-box">
                        <div class="input-group input-group-sm">
                            <input class="form-control" placeholder="Enter your coupon code" aria-label="Coupon code" type="text">
                            <div class="input-group-append">
                                <button class="btn btn-theme" type="button">Apply Coupon</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6">
                    <div class="update-box">
                        <input value="Update Cart" type="submit">
                    </div>
                </div>
            </div>

            <div class="row my-5">
                <div class="col-lg-8 col-sm-12"></div>
                <div class="col-lg-4 col-sm-12">
                    <div class="order-box">
                        <h3>Order summary</h3>
                        <div class="d-flex">
                            <h4>Sub Total</h4>
                            <div class="ml-auto font-weight-bold"> $ 130 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Discount</h4>
                            <div class="ml-auto font-weight-bold"> $ 40 </div>
                        </div>
                        <hr class="my-1">
                        <div class="d-flex">
                            <h4>Coupon Discount</h4>
                            <div class="ml-auto font-weight-bold"> $ 10 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Tax</h4>
                            <div class="ml-auto font-weight-bold"> $ 2 </div>
                        </div>
                        <div class="d-flex">
                            <h4>Shipping Cost</h4>
                            <div class="ml-auto font-weight-bold"> Free </div>
                        </div>
                        <hr>
                        <div class="d-flex gr-total">
                            <h5>Grand Total</h5>
                            <div class="ml-auto h5"> $ 388 </div>
                        </div>
                        <hr> </div>
                </div>
                <div class="col-12 d-flex shopping-box"><a href="checkout.html" class="ml-auto btn hvr-hover">Checkout</a> </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

@endsection