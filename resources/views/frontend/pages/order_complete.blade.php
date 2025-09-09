<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="style.css">
  <style type="text/css">
        .gradient-custom {
    /* fallback for old browsers */
    background: #1D3131;

    /* Chrome 10-25, Safari 5.1-6 */
    background: #1D3131;

    /* W3C, IE 10+/ Edge, Firefox 16+, Chrome 26+, Opera 12+, Safari 7+ */
    background: #1D3131;
    }
  </style>
	<title>Order Card</title>
</head>
<body>
<section class="h-100 gradient-custom">
  <div class="container py-5 h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-10 col-xl-8">
        <div class="card" style="border-radius: 10px;">
          <div class="card-header px-4 py-5">
            <h5 class=" mb-0">Thank you for placing an Order, <span style="color: #59A5A3; flex: left;">{{$order->name}}</span>!<span style="float: right;"><a href="{{url('/')}}"><img height="162" width="162" src="{{asset('public/frontend/asset/images/logo/Mushroomverse_web_logo.png')}}"></a></span></h5>
          </div>
            
          
          <div class="card-body p-4">
            <div class="d-flex justify-content-between align-items-center mb-4">
              <p class="lead fw-normal mb-0" style="color: #a8729a;">Invoice</p>
              <p class="small  mb-0"></p>
            </div>
            
            @php $total_price = 0; @endphp
            @foreach($order->carts as $cart)
            @php $total_price += $cart->product_price * $cart->product_quantity @endphp
            <div class="card shadow-0 border mb-4">
              <div class="card-body">
                <div class="row">
                  <div class="col-md-2">
                    @php $image = $cart->product_image; @endphp
                    
                    @if($image)
                    <img src="{{URL::to($image)}}" class="img-fluid" alt="Phone">
                      @else
                    <img src="{{asset('public/admin/images/icons/default-image_550.png')}}" class="img-fluid" alt="Phone">  
                      @endif
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">

                    <p class=" mb-0">{{$cart->product_title}}</p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class=" mb-0 small">@if($cart->brand_name) {{$cart->brand_name}} @else N/A @endif</p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="mb-0 small">{{$cart->measurement_weight}}</p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class=" mb-0 small">{{$cart->product_quantity}}</p>
                  </div>
                  <div class="col-md-2 text-center d-flex justify-content-center align-items-center">
                    <p class="mb-0 small">Tk {{$cart->product_price * $cart->product_quantity}}</p>
                  </div>
                </div>
                <hr class="mb-4" style="background-color: #e0e0e0; opacity: 1;">
            </div>
            @endforeach

            <div class="d-flex justify-content-between pt-2">
              <p class="fw-bold mb-0">Order Details</p>
              
            </div>

    <div class="d-flex justify-content-between pt-2">
        <p class=" mb-0">Invoice Number : {{$order->invoice_no}}</p>
        <p class="mb-0"><span class="fw-bold me-4">Total</span> {{$total_price}} ৳</p>
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
        <p class="mb-0"><span class="fw-bold me-4">Total Due</span> {{$order->amount + $order->delivery_charge}} ৳</p>
    </div>
          </div>
          <div class="card-footer border-0 px-4 py-5"
            style="background-color: #59A5A3; border-bottom-left-radius: 10px; border-bottom-right-radius: 10px;">
            <h5 class="d-flex align-items-center justify-content-end text-white text-uppercase mb-0">Total
              due: <span class="h2 mb-0 ms-2">{{$total_price + $order->delivery_charge}} ৳</span></h5>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>
<script type="text/javascript" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js"></script>
</body>
</html>