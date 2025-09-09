@extends('frontend.layouts.app')
@section('content')

    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Checkout</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/products')}}">Shop</a></li>
                        <li class="breadcrumb-item active">Checkout</li>
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
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="checkout-address">
                        <div class="title-left">
                            <h3>Billing address</h3>
                                <!-- Display Validation Errors -->
@if ($errors->any())
    <div class="alert alert-danger">
        <strong>Please fix the following errors:</strong>
        <ul style="list-style-type: none; padding-left: 0;">
            @foreach ($errors->all() as $error)
                <li>&bull; {{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
                        </div>
                        <form action="{{route('single_order.place')}}" method="POST" enctype="multipart/form-data" class="needs-validation" >
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label for="firstName">First name *</label>
                                    <input type="text" name="first_name" class="form-control" id="firstName" placeholder="" value="{{ old('first_name')}}" required>
                                    @error('first_name')
                                    <div class="error">{{ $message }}</div>
                                    @enderror
                                    <!--<div class="invalid-feedback"> Valid first name is required. </div>--->
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label for="lastName">Last name *</label>
                                    <input type="text" name="last_name" class="form-control" id="lastName" placeholder="" value="{{old('last_name')}}" required>
                                     @error('last_name')
                                    <div class="error">{{ $message }}</div>
                                    @enderror                                   
                                    <!--<div class="invalid-feedback"> Valid last name is required. </div>-->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="username">Phone No*</label>
                                <div class="input-group">
                                    <input type="tel" name="phone_no" class="form-control" id="phone_no" placeholder="" required value="{{old('phone_no')}}">
                                     @error('phone_no')
                                    <div class="error">{{ $message }}</div>
                                    @enderror                                     
                                    <!--<div class="invalid-feedback" style="width: 100%;"> Your phone no is required. </div>-->
                                </div>
                            </div>
                            <div class="mb-3">
                                <label for="email">Email Address *</label>
                                <input type="email" name="email" class="form-control" id="email" placeholder="" required value="{{old('email')}}">
                                @error('email')
                                <div class="error">{{ $message }}</div>
                                @enderror                                  
                                <!--<div class="invalid-feedback"> Please enter a valid email address for delivery updates. </div>-->
                            </div>
                            <div class="mb-3">
                                <label for="address">Address *</label>
                                <input type="text" name="address" class="form-control" id="address" placeholder="" required value="{{old('address')}}">
                                @error('address')
                                <div class="error">{{ $message }}</div>
                                @enderror                                
                                <!--<div class="invalid-feedback"> Please enter your delivery address. </div>-->
                            </div>
                            
                            <div class="row">
                                <div class="col-md-5 mb-3">
                                    <label for="country">Division *</label>
                                    <select class="wide w-100" id="division_id" required name="division_id">
                                    <option value="" data-display="Select">Choose a division</option>                                      
                                    @foreach(App\Models\Division::get() as $division)
                                    <option value="{{$division->id}}" data-display="Select">{{$division->name}}</option>
                                    @endforeach
                                    </select>

                                @error('division_id')
                                <div class="error">{{ $message }}</div>
                                @enderror                                      
                                
                                    <!--<div class="invalid-feedback"> Please select a valid Division. </div>-->
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label for="state">District *</label>
                                    <select class="wide w-100" id="district_id" required name="district_id">
                                    <option value="" data-display="Select">Choose a division</option>                                      
                                    @foreach(App\Models\District::get() as $district)
                                    <option value="{{$district->id}}" data-display="Select">{{$district->name}}</option>
                                    @endforeach
                                @error('district_id')
                                <div class="error">{{ $message }}</div>
                                @enderror                                    
                                </select>
                                    <!--<div class="invalid-feedback"> Please provide a valid District. </div>-->
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label for="zip">Zip *</label>
                                    <input type="text" name="zip" class="form-control" id="zip" placeholder="" required value="{{old('zip')}}">
                                @error('zip')
                                <div class="error">{{ $message }}</div>
                                @enderror                                     
                                    <!--<div class="invalid-feedback"> Zip code required. </div>-->
                                </div>
                            </div>
                            <hr class="mb-4">
                            <!--<div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="same-address">
                                <label class="custom-control-label" for="same-address">Shipping address is the same as my billing address</label>
                            </div>
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="save-info">
                                <label class="custom-control-label" for="save-info">Save this information for next time</label>
                            </div>-->
                            <hr class="mb-4">
                            <span class="text-slid-box text-light bg-info fw-bold">Note: Home delivery of fresh mushrooms is unavailable outside Dhaka.</span>
                            <div class="title"> <span>Payment Method</span> </div>
                            <div class="d-block my-3">
                                <div class="custom-control custom-radio">
                                    <input id="paypal" name="payment_method" type="radio" class="custom-control-input" required value="Cash_On_Delivery">
                                    <label class="custom-control-label" for="paypal">Cash on delivery</label>
                                @error('payment_method')
                                <div class="error">{{ $message }}</div>
                                @enderror                                     
                                </div>                                
                                

                            </div>
                            
                            
                            <hr class="mb-1"> 

                        <input type="hidden" name="transaction_id" value="31wr5344w35">
                        <input type="hidden" name="product_id" value="{{$product['product_id']}}">
                        <input type="hidden" name="measurement_id" value="{{$product['weight_id']}}">
                        <input type="hidden" name="total_items" value="{{$product['quantity']}}">
                        
                        <input type="hidden" name="product_price" value="{{$product['amount']}}">
                        <input type="hidden" name="amount" value="{{$product['amount'] * $product['quantity'] }}">
                        <div class="col-12 d-flex shopping-box"> <button  class="ml-auto btn hvr-hover text-light" type="submit">Place Order</button> </div>                        
                        </form>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-6 mb-3">
                    <div class="row">
                        
                        <div class="col-md-12 col-lg-12">
                            <div class="odr-box">
                                <div class="title-left">
                                    <h3>Item</h3>
                                </div>
                                <div class="rounded p-2 bg-light">

                                    <div class="media mb-2">
                    @php $weight = App\Models\ProductWeight::where('id',$product['weight_id'])->first(); @endphp
                                        <div class="media-body"> <a href="detail.html"> {{$product['product_title']}}</a>
                                            <div class="small text-muted">Price: Tk {{$product['amount']}} <span class="mx-2">|</span> Weight: {{$weight->measurement->weight}} g<span class="mx-2">|</span> Qty: {{$product['quantity']}} <span class="mx-2">|</span> Total: Tk {{$product['amount'] * $product['quantity']}}</div>
                                             
                                        </div>
                                    </div>
                                    
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12 col-lg-12">
                            <div class="order-box">
                                <div class="title-left">
                                    <h3>Your order</h3>
                                </div>
                                <div class="d-flex">
                                    <div class="font-weight-bold">Product</div>
                                    <div class="ml-auto font-weight-bold">Total</div>
                                </div>
                                <hr class="my-1">
                                <div class="d-flex">
                                    <h4>Sub Total</h4>
                                    <div class="ml-auto font-weight-bold"> Tk {{$product['amount'] * $product['quantity']}} </div>
                                </div>
                                <hr class="my-1">
                                
                                
                                <div class="d-flex">
                                    <h4>Delivery Charge</h4>
                                    <div class="ml-auto font-weight-bold">Tk 60</div>
                                </div>
                                <hr>
                                <div class="d-flex gr-total">
                                    <h5>Grand Total</h5>
                                    @php $grand_total =  $product['amount'] * $product['quantity'] + 60 @endphp
                                    <div class="ml-auto h5"> {{$grand_total}} ৳</div>
                                </div>
                                <hr>
                            </div>
                        </div>

                        
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- End Cart -->

@endsection    