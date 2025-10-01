@extends('frontend.layouts.app')
@section('content')
      <div class="col-lg-10 col-xl-8 mx-auto">
        <div class="card d-flex justify-content-center " style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h2 class=" mb-0 text-center" >My Orders <span style="color: #59A5A3;"></span>!</h2>
          </div>@php $grand_total = 0 @endphp
          @php $orders = App\Models\Order::orders(); @endphp
          @if(count($orders) > 0)
          @foreach($orders as $order)
<div class="card-body p-4" align="center">
    <div class="d-flex justify-content-center align-items-center mb-4">
        <h1 class=" mb-0" style="color: #a8729a;">Order No. #{{$order->id}}</h1>
        <p class="small mb-0 ms-3"></p> <!-- ms-3 to add space between elements -->
    </div>

    @if($order->product_id)
    <div class="card shadow-0 border mb-4">
        <div class="card-body">
            <div class="row justify-content-center"> <!-- Center the entire row -->
                <div class="col-md-2">
                    @php $image = $order->product_image; @endphp
                    
                    @if($image)
                    <img src="{{URL::to($image)}}" class="img-fluid" alt="Product Image">
                    @else
                    <img src="{{asset('admin/images/icons/default-image_550.png')}}" class="img-fluid" alt="Product Image">
                    @endif
                </div>
                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class=" mb-0">{{$order->product_title}}</p>
                </div>
                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class=" mb-0 small">Brand: @if($order->product_brand){{$order->product_brand}} @else N/A @endif</p>
                </div>
                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class=" mb-0 small">Capacity: {{$order->product_weight}}</p>
                </div>
                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class=" mb-0 small">Qty: {{$order->total_items}}</p>
                </div>
                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="mb-0 small">Price: {{$order->product_price}} X {{$order->total_items}}= Tk {{$order->product_price * $order->total_items}} </p>
                </div>
            </div>
            <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
        </div>
    </div>    
    @else
    @foreach($order->carts as $cart)
   
    <div class="card shadow-0 border mb-4">
        <div class="card-body">
            <div class="row justify-content-center"> <!-- Center the entire row -->
                <div class="col-md-2">
                    @php $image = $cart->product_image @endphp
                    
                    @if($image)
                    <img src="{{URL::to($image)}}" class="img-fluid" alt="Product Image">
                    @else
                    <img src="{{asset('admin/images/icons/default-image_550.png')}}" class="img-fluid" alt="Product Image">
                    @endif

                </div>
                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class=" mb-0">{{$cart->product_title}}</p>
                </div>
                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class=" mb-0 small">Brand: @if($cart->brand_name){{$cart->brand_name}} @else N/A @endif</p>
                </div>
                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class=" mb-0 small">Capacity: {{$cart->measurement_weight}}</p>
                </div>
                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class=" mb-0 small">Qty: {{$cart->product_quantity}}</p>
                </div>
                <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="mb-0 small">{{$cart->product_price}} X {{$cart->product_quantity}}= Tk {{$cart->product_price*$cart->product_quantity}} ৳</p>
                </div>
            </div>
            <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
        </div>
    </div>
    @endforeach
    @endif
    <br>
    @php $grand_total += $order->amount + $order->delivery_charge; @endphp
    <div class="d-flex justify-content-between pt-2">
        <p class="fw-bold mb-0">Order Details</p>
        
    </div>

    <div class="d-flex justify-content-between pt-2">
        <p class=" mb-0"><a href="{{route('invoice.generator',$order->id)}}">Invoice Number : {{$order->invoice_no}}</a> </p>
        <p class="mb-0"><span class="fw-bold me-4">Total</span>Tk: {{$order->amount}} </p>
    </div>

    <div class="d-flex justify-content-between">
              
              <p class="mb-0"><span class="fw-bold me-4">Status:</span> @if($order->status == 4) Pending @elseif($order->status == 3) Confirmed @elseif($order->status == 2) Up for delivery @elseif($order->status == 1) Complete @endif</p>
              <p class=" mb-0"><span class="fw-bold me-4">Delivery Charge</span> {{$order->delivery_charge}} ৳</p>
    </div>    

    <div class="d-flex justify-content-between">
        <p class="mb-0">Invoice Date : {{ $order->created_at->format('l, F j, Y g:i A') }}</p>
        
    </div>

    <div class="d-flex justify-content-between mb-5">
        <p class="mb-0">Estimated Delivery Date : {{ \Carbon\Carbon::parse($order->delivery_date)->format('l, F j, Y') }}</p>
        <p class="mb-0"><span class="fw-bold me-4">@if($order->paid == 1)Total Paid @else Total Due @endif</span> {{$order->amount + $order->delivery_charge}} ৳</p>
    </div>
</div>

          @endforeach
          <div class="card-footer border-0 px-4 py-5"
            style="background-color: #59A5A3; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <h1 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Grand Total
              : <span class="h2 mb-0 ms-2">{{$grand_total}} ৳</span></h1>
          </div>
          @else
          <div class="card-body p-4" align="center">
            <h1 align="center">You haven't placed any order yet!</h1>
          </div>
          @endif
        </div>
      </div>
@endsection