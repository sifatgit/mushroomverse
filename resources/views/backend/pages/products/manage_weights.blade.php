@extends('backend.index')
@section('content')
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h6>Add Fresh Mushroom</h6>

                
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default">Add <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h6>Add Canned Mushroom<sup style="font-size: 20px"></sup></h6>

                
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default1">Add <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h6>Add Dry Mushroom</h6>

                
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default2">Add <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h6>Add Mushroom Powder</h6>

                
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer" data-toggle="modal" data-target="#modal-default3">Add <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
    <section class="content">
            <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products Stock Table</h3><br>


              
              </div>

              <!-- /.card-header -->
              <div class="card-body">
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Brand</th>
                    <th>Category</th>                    
                    <th>Image</th>
                    <th>Price</th>
                    <th>Weight</th>
                    <th>Quantity/Availablity</th>

                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($data as $stock)
                    <tr>
                      <td>{{$stock->id}}</td>
                        <td>{{$stock->product->title}}</td>                      
                        <td>@if($stock->product->category->type == 2){{$stock->product->brand->name}} @else N/A @endif</td>
                        <td>{{$stock->product->category->name}}</td>
                        @php $images = explode("|",$stock->product->images); @endphp
                        <td><img class="d-block" style="width: 50px; height: 40px;" src="{{URL::to($images[0])}}"></td>                                                                              
                        <td>{{$stock->price}}</td>                                          
                        <td>{{$stock->measurement->weight}}</td>                     
                        <td>@if($stock->product->category->type == 2) {{$stock->quantity}} @endif @if($stock->product->category->type != 2) @if($stock->availability == 1 ) Available @else Currently Unavailable @endif @endif</td>                     
                      <td>


        


        <a id="delete" href="{{route('admin.weight.delete',$stock->id)}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg></a>

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
    </section>






@endsection

                <!-- Fresh Mushroom Product store modal-->


                  <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                      <div class="modal-content" >
                        <div class="modal-header">
                          <h4 class="modal-title">Add weight for fresh mushrooms</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">

                           <form action="{{route('admin.weight.store')}}" method="Post" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group">
                               <label for="exampleInputPassword1">Mushroom</label>
                               <select class="form-control @error('product_id') is-invalid @enderror" name="product_id">
                                 <option value="">Please select a Mushroom</option>
                                  @php 
                                  $first_category = App\Models\Category::where('type',1)->first();
                                  @endphp
                                  @if($first_category)
                                 @foreach($first_category->products as $product)
                                  <option value="{{$product->id}}">{{$product->title}}</option>                                  
                                 @endforeach
                                 @endif
                               </select>
                             </div>

                            <div class="form-group">
                              <label>Price</label>
                               <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"  required >

                               @error('price')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror                              
                            </div>


                             <div class="form-group">
                               <label>Weight</label>
                               <select class="form-control @error('measurement_id') is-invalid @enderror" name="measurement_id">
                                 <option value="">Please select a Weight</option>
                                 @foreach(App\Models\Measurement::get() as $measurement)
                                  <option value="{{$measurement->id}}">{{$measurement->weight}}</option>
                                 @endforeach
                               </select>
                               @error('measurement_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                             </div>

                            
                            
                             <button type="submit" class="btn btn-success btn-block">Add</button>
                           </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>


                <!-- Canned Mushroom Product store modal-->


                  <div class="modal fade" id="modal-default1">
                    <div class="modal-dialog">
                      <div class="modal-content" >
                        <div class="modal-header">
                          <h4 class="modal-title">Add Weight for canned mushroom</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">

                           <form action="{{route('admin.weight.store')}}" method="Post" enctype="multipart/form-data">
                            @csrf

                             <div class="form-group">
                               <label>Canned Mushrooms</label>
                               <select class="form-control @error('product_id') is-invalid @enderror" name="product_id">
                                 <option value="">Please select a Canned Mushroom</option>
                                  @php 
                                  $second_category = App\Models\Category::where('type',2)->first();
                                  @endphp
                                  @if($second_category)
                                 @foreach($second_category->products as $product)
                                  
                                  <option value="{{$product->id}}">{{$product->title}}</option>
                                  
                                 @endforeach
                                 @endif
                               </select>
                               @error('product_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                             </div>                            

                             <div class="form-group">
                               <label>Brand</label>
                               <select class="form-control @error('brand_id') is-invalid @enderror" name="brand_id">
                                 <option value="">Please select a Brand</option>
                                 @foreach(App\Models\Brand::get() as $brand)
                                  <option value="{{$brand->id}}">{{$brand->name}}</option>
                                 @endforeach
                               </select>
                               @error('brand_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                             </div>    

                            <div class="form-group">
                              <label>Price</label>
                               <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"  required >

                               @error('price')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror                              
                            </div>
                             <div class="form-group">
                               <label>Weight</label>
                               <select class="form-control @error('measurement_id') is-invalid @enderror" name="measurement_id">
                                 <option value="">Please select a Weight</option>
                                 @foreach(App\Models\Measurement::get() as $measurement)
                                <option value="{{$measurement->id}}">{{$measurement->weight}}</option>
                                 @endforeach
                               </select>
                               @error('measurement_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                             </div>
                             
                            
                            
                             <button type="submit" class="btn btn-success btn-block">Add</button>
                           </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>                  

                <!-- Dry Mushroom Product store modal-->


                  <div class="modal fade" id="modal-default2">
                    <div class="modal-dialog">
                      <div class="modal-content" >
                        <div class="modal-header">
                          <h4 class="modal-title">Add weight for dry mushrooms</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">

                           <form action="{{route('admin.product.store')}}" method="Post" enctype="multipart/form-data">
                            @csrf                             

                              
                            <div class="form-group">
                               <label for="exampleInputPassword1">Mushroom</label>
                               <select class="form-control @error('product_id') is-invalid @enderror" name="product_id">
                                 <option value="">Please select a Mushroom</option>
                                  @php 
                                  $third_category = App\Models\Category::where('type',3)->first();
                                  @endphp
                                  @if($third_category)
                                 @foreach($third_category->products as $product)
                                  <option value="{{$product->id}}">{{$product->title}}</option>                                  
                                 @endforeach
                                 @endif
                               </select>
                             </div>

                            <div class="form-group">
                              <label>Price</label>
                               <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"  required >

                               @error('price')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror                              
                            </div>

                             <div class="form-group">
                               <label>Weight</label>
                               <select class="form-control @error('measurement_id') is-invalid @enderror" name="measurement_id">
                                 <option value="">Please select a Weight</option>
                                 @foreach(App\Models\Measurement::get() as $measurement)
                                  <option value="{{$measurement->id}}">{{$measurement->weight}}</option>
                                 @endforeach
                               </select>
                               @error('measurement_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                             </div>

                            
                            
                             <button type="submit" class="btn btn-success btn-block">Add</button>
                           </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>                                    


                <!-- Powder Mushroom Product store modal-->


                  <div class="modal fade" id="modal-default3">
                    <div class="modal-dialog">
                      <div class="modal-content" >
                        <div class="modal-header">
                          <h4 class="modal-title">Add Weight for powder mushroom</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">

                           <form action="{{route('admin.product.store')}}" method="Post" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                               <label for="exampleInputPassword1">Mushroom</label>
                               <select class="form-control @error('product_id') is-invalid @enderror" name="product_id">
                                 <option value="">Please select a Mushroom</option>
                                  @php 
                                  $fourth_category = App\Models\Category::where('type',4)->first();
                                  @endphp
                                  @if($fourth_category)
                                 @foreach($fourth_category->products as $product)
                                  <option value="{{$product->id}}">{{$product->title}}</option>                                  
                                 @endforeach
                                 @endif
                               </select>
                             </div>

                            <div class="form-group">
                              <label>Price</label>
                               <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"  required >

                               @error('price')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror                              
                            </div>

                             <div class="form-group">
                               <label>Weight</label>
                               <select class="form-control @error('measurement_id') is-invalid @enderror" name="measurement_id">
                                 <option value="">Please select a Weight</option>
                                 @foreach(App\Models\Measurement::get() as $measurement)
                                  <option value="{{$measurement->id}}">{{$measurement->weight}}</option>
                                 @endforeach
                               </select>
                               @error('measurement_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                             </div>

                            
                            
                             <button type="submit" class="btn btn-success btn-block">Add</button>
                           </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>                                    