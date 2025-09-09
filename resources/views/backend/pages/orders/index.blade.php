@extends('backend.index')
@section('content')
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Orders Table</h3><br>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
              
                <table id="example2" class="table table-responsive table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Customer Name</th>
                    <th>Phone No.</th>
                    <th>Email</th>
                    <th>Division</th>
                    <th>District</th>
                    <th>Address</th>
                    <th>Zip Code</th>
                    <th>IP address</th>
                    <th>Total Items</th>
                    <th>Total Amount</th>
                    <th>Payment Method</th>
                    <th>Transaction ID</th>
                    <th>Invoice No.</th>
                    <th>Order Placement Date</th>
                    <th>Delivery Date</th>
                    <th>Status</th>                                        
                    <th>Paid</th>                                        
                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($data as $order)
                    <tr>
                      <td>{{$order->id}}</td>
                        <td>{{$order->name}}</td>                                            
                        <td>{{$order->phone_no}}</td>                     
                        <td>{{$order->email}}</td>                     
                        <td>{{$order->division_name}}</td>                     
                        <td>{{$order->district_name}}</td>                     
                        <td>{{$order->address}}</td>                     
                        <td>{{$order->zip}}</td>                     
                        <td>{{$order->ip_address}}</td>                     
                        <td>{{$order->total_items}}</td>                     
                        <td>{{$order->amount}}</td>                     
                        <td>{{$order->payment_method}}</td>                     
                        <td>{{$order->transaction_id}}</td>                     
                        <td>{{$order->invoice_no}}</td>                     
                        <td>{{$order->created_at->format('j F Y, l, g:i a')}}</td>                     
                        <td>{{ \Carbon\Carbon::parse($order->delivery_date)->format('F j, Y') }}</td>                     
                        <td>
                          <form class="order-status" action="{{route('admin.order.status.update',$order->id)}}" method="POST" enctype="multipart/form-data" >
                          @csrf
                          <select class="form-control" name="status" required>
                          <option class="bg-warning" value="4" {{$order->status == 4 ? 'selected' : ''}} >Pending</option>
                          <option class="bg-primary" value="3" {{$order->status == 3 ? 'selected' : ''}}>Confirmed</option>
                          <option class="bg-info" value="2" {{$order->status == 2 ? 'selected' : ''}}>Up for delivery</option>
                          <option class="bg-success" value="1" {{$order->status == 1 ? 'selected' : ''}}>Complete</option>
                          <option class="bg-danger" value="0" {{$order->status == 0 ? 'selected' : ''}}>Declined</option>
                          </select>
                          <br>
                          <button type="submit">Change</button>
                          </form>
                    </td>
                        <td>@if($order->paid == 1)Paid @else Not paid @endif</td>                     
     

                      <td><a data-toggle="modal" data-target="#modal-default1{{$order->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="skyblue" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>

        <a id="delete" href="{{route('admin.order.delete',$order->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg></a>

<a data-toggle="modal" data-target="#modal-default2{{$order->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="orange" class="bi bi-folder2-open" viewBox="0 0 16 16">
  <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg></a>
        <!--order view modal-->
      <div class="modal fade" id="modal-default2{{$order->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View Ordered Items</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header"><h2>Invoice No. {{$order->invoice_no}}</h2></div>
                 <div class="card-body">
        <table id="example2" class="table table-responsive table-bordered table-hover">
          <thead>
            <tr>
              <td>ID</td>
              <td>Image</td>
              <td>Product</td>
              <td>Weight</td>
              <td>Brand</td>
              <td>Quantity</td>
              <td>Remove</td>
            </tr>
          </thead>
          <tbody>
          @foreach($order->carts as $cart) 
            <tr class="remove-pr-{{$cart->id}}">
              <td>{{$cart->id}}</td>
              @php $image = $cart->product_image @endphp
              <td><img src="{{URL::to($image)}}" style="width:50px; height:45px;"></td>
              <td>{{$cart->product_title}}</td>
              <td>{{$cart->measurement_weight}}</td>
              <td>@if($cart->brand_name){{$cart->brand_name}} @else N/A @endif</td>
              <td>{{$cart->product_quantity}}</td>
              <td><a class="remove_link" data-id="{{$cart->id}}" href="#" >
                  <i class="fas fa-times"></i>
                </a></td>
            </tr>
            @endforeach
          </tbody>
        </table>
          
        </div>
          <div class="container">
            <div class="row">
              <div class="details">
                
              </div>
            </div>
          </div>
              
                   
                 </div>
               </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> 

    <!--product update modal-->
      <div class="modal fade" id="modal-default1{{$order->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit Order</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <form action="{{route('admin.order.update',$order->id)}}" method="Post" enctype="multipart/form-data">
                @csrf


                          <div class="form-group">
                               <label for="exampleInputPassword1">Name</label>
                               <input type="text" class="form-control @error('Name') is-invalid @enderror" name="name" required value="{{$order->name}}">


                                @error('name')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                             

                              <div class="form-group">
                               <label for="exampleInputPassword1">Phone No:</label>
                               <input type="tel" class="form-control @error('phone_no') is-invalid @enderror" name="phone_no"  required value="{{$order->phone_no}}" >

                               @error('phone_no')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                              <div class="form-group">
                               <label for="exampleInputPassword1">Email</label>
                               <input type="email" class="form-control @error('email') is-invalid @enderror" name="email"  required value="{{$order->email}}" >

                               @error('email')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                              <div class="form-group">
                               <label for="exampleInputPassword1">Division</label>
                               <select class="form-control @error('division_id') is-invalid @enderror" name="division_id"> 
                                <option value="">Select a division</option>
                                @foreach(App\Models\Division::get() as $div)
                                <option value="{{$div->id}}" {{$order->division_name==$div->name ? 'selected' :''}} >{{$div->name}}</option>
                                @endforeach
                               </select>

                               @error('division_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                              <div class="form-group">
                               <label for="exampleInputPassword1">District</label>
                               <select class="form-control @error('district_id') is-invalid @enderror" name="district_id"> 
                                <option value="">Select a District</option>
                                @foreach(App\Models\District::get() as $dis)
                                <option value="{{$dis->id}}" {{$order->district_name==$dis->name ? 'selected' :''}} >{{$dis->name}}</option>
                                @endforeach
                               </select>

                               @error('district_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>


                             <div class="form-group">
                               <label>Address</label>
                               <textarea class="form-control @error('address') is-invalid @enderror" name="address">
                                 {{$order->address}}
                               </textarea>


                               @error('address')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div> 

                                <div class="form-group">
                                    <label for="zip">Zip *</label>
                                    <input type="text" name="zip" class="form-control" id="zip" placeholder="" required value="{{$order->zip}}">

                                @error('zip')
                                <div class="error">{{ $message }}</div>
                                @enderror                                     
                                    <!--<div class="invalid-feedback"> Zip code required. </div>-->
                                </div>

                                <div class="form-group">
                                  <label>IP Address</label> 
                                  <span>{{$order->ip_address}}</span>
                                </div>

                                <div class="form-group">
                                  <label>Total Items</label> 
                                  <span>{{$order->total_items}}<input type="number" name="total_items" value="{{$order->total_items}}"></span>

                                <div class="form-group">
                                  <label>Total Amount</label> 
                                  <input class="form-control @error('amount') is-invalid @enderror" type="number" name="amount" value="{{$order->amount}}">
                                  
                                @error('amount')
                                <div class="error">{{ $message }}</div>
                                @enderror 
                                </div>


                              <div class="form-group">
                               <label for="exampleInputPassword1">Payment Method</label>
                               <select class="form-control @error('payment_method') is-invalid @enderror" name="payment_method"> 
                                <option value="Cash_On_Delivery" selected>Select a Payment Method</option>
                                @foreach(App\Models\Payment::where('status',1)->get() as $pay)
                                <option value="{{$pay->id}}" {{$order->payment->id==$pay->id ? 'selected' :''}} >{{$pay->name}}</option>
                                @endforeach
                               </select>

                               @error('payment_method')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>


                             <div class="form-group">  
                              <label>Transaction ID</label>
                              <span>@if($order->transaction_id != NULL){{$order->transaction_id}} @else N/A @endif</span>
                             </div> 

                              <div class="form-group">  
                              <label>Invoice No.</label>
                              <input class="form-control @error('invoice_no') is-invalid @enderror" type="text" name="invoice_no" value="{{$order->invoice_no}}">

                              @error('invoice_no')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror                              
                             </div>


                             <div class="form-group">  
                              <label>Status</label>
                              <select class="form-control @error('status') is-invalid @enderror" name="status" >

                                <option value="">Select a status</option>
                                <option value="1" selected>Pending</option>
                                <option value="2">Confirmed</option>
                                <option value="3">Complete</option>
                                <option value="4">Declined</option>

                              </select>

                              @error('invoice_no')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror                              
                             </div>                                                                                                                                                                                                                                                                       
                             <button type="submit" class="btn btn-success btn-block">Update</button>
               </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

        


        
             






</td>
                    </tr>

    





    
                    @endforeach                 
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
              
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
      <!-- /.container-fluid -->

    <!-- /.content -->   
 
  
@endsection