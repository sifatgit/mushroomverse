@extends('backend.index')
@section('content')


      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Products Table</h3><br>
                <button class="btn btn-primary btn-sm" style="float: right;"  data-toggle="modal" data-target="#modal-default">Add New</button>


                <!--Product store modal-->


                  <div class="modal fade" id="modal-default">
                    <div class="modal-dialog">
                      <div class="modal-content" >
                        <div class="modal-header">
                          <h4 class="modal-title">Add New product</h4>
                          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                          </button>
                        </div>

                        <div class="modal-body">

                           <form action="{{route('admin.product.store')}}" method="Post" enctype="multipart/form-data">
                            @csrf


                            <div class="form-group">
                               <label for="exampleInputPassword1">Title</label>
                               <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" value="{{old('title')}}" required>


                                @error('title')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>


                          <div class="form-group" >
                            <label>Image  (maximum 3)</label>
                            <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple>
                          </div>

                              @error('images')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror


                            <div class="form-group">
                               <label>Description</label>
                               <textarea name="description" class="form-control @error('description') is-invalid @enderror" required></textarea>


                                @error('description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                             

                              <div class="form-group">
                               <label for="exampleInputPassword1">Price</label>
                               <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"  required >

                               @error('price')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                             <div class="form-group">
                               <label>Category</label>
                               <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                 <option value="">Please select a Category</option>
                                 @foreach(App\Models\Category::get() as $category)
                                  <option value="{{$category->id}}">{{$category->name}}</option>
                                 @endforeach
                               </select>
                               @error('category_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                             </div>

                             <div class="form-group">
                               <label>Brands</label>
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
                            
                             <button type="submit" class="btn btn-success btn-block">Add</button>
                           </form>
                        </div>
                      </div>
                      <!-- /.modal-content -->
                    </div>
                    <!-- /.modal-dialog -->
                  </div>
              </div>

              <!-- /.card-header -->
              <div class="card-body">
              
                <table id="example2" class="table table-bordered table-hover">
                  <thead>
                  <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Brand</th>
                    <th>Image</th>
                    <th>Description</th>
                    <th>Slug</th>
                    <th>Price</th>
                    <th>Quantity/Availablity</th>
                    <th>Category</th>
                    <th>Sale</th>
                    <th>Featured</th>

                    <th>Action</th>

                  </tr>
                  </thead>
                  <tbody>
          
          @foreach($data as $product)
                    <tr>
                      <td>{{$product->id}}</td>
                        <td>{{$product->title}}</td>                      
                        <td>@if($product->category_id && $product->category->type == 2 && $product->brand_id){{$product->brand->name}} @else N/A @endif</td>                      
                        <td>
                          <!-- Button trigger modal -->
      <a href="#" class="btn btn-lg btn-primary" data-toggle="modal" data-target="#largeModal{{$product->id}}">View Photos</a>

      <!--Slider Modal-->
            <div class="modal fade" id="largeModal{{$product->id}}" tabindex="-1" role="dialog" aria-labelledby="basicModal" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-body">
<div id="carouselExampleControls1{{$product->id}}" class="carousel slide" data-ride="carousel">
  <div class="carousel-inner">
    

    @foreach(explode("|",$product->images) as $image)
    <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
      <img class="d-block w-100 img-responsive" src="{{URL::to($image)}}" style="width:700px; height:700px;" alt="First slide">
    </div>
    @endforeach
 
  </div>
  <a class="carousel-control-prev" href="#carouselExampleControls1{{$product->id}}" role="button" data-slide="prev">
    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
    <span class="sr-only">Previous</span>
  </a>
  <a class="carousel-control-next" href="#carouselExampleControls1{{$product->id}}" role="button" data-slide="next">
    <span class="carousel-control-next-icon" aria-hidden="true"></span>
    <span class="sr-only">Next</span>
  </a>
</div>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
              </div>
            </div>
          </div>


                        </td>                                           
                        <td>{{$product->description}}</td>                     
                        <td>{{$product->slug}}</td>                     
                        <td>{{$product->price}}</td>                     
                        <td>
                        @if($product->category_id && $product->category->type == 2)  
                        @php $quantity = 0; @endphp 
                        @foreach($product->productweight as $wgt)
                        @php $quantity += $wgt->quantity; @endphp
                        @endforeach

                        @if($quantity > 0)
                        {{$quantity}} <p id="quantity{{$product->id}}" class="bg-success"> piece available</p>
                        @else <p id="quantity{{$product->id}}" class="bg-warning" align="center">Out of stock</p>
                        @endif
                        @endif

                        @if($product->category_id && $product->category->type != 2)

                        @php $productavailability = App\Models\ProductWeight::where('product_id',$product->id)->where('availability',1)->get();

                        @endphp
                        @if(count($productavailability) > 0)
                        <p id="quantity{{$product->id}}" class="bg-success" align="center"> Available</p>
                        @else
                        <p id="quantity{{$product->id}}" class="bg-warning" align="center"> Unavailable</p>
                        @endif
                        @endif
                        </td>
                        @if($product->cateogory_id)                     
                        <td>{{$product->category->name}}</td>
                        @else                     
                        <td>N/A</td>
                        @endif                     
                        <td>@if($product->sale == 1) Yes @else No @endif</td>                    
                        <td>@if($product->featured == 1) Yes @else No @endif</td>                     
                  
     

                      <td><a data-toggle="modal" data-target="#modal-default1{{$product->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="skyblue" class="bi bi-pencil-square" viewBox="0 0 16 16">
  <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z"/>
  <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z"/>
</svg></a>
    <!--product update modal-->
      <div class="modal fade" id="modal-default1{{$product->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Edit product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <form action="{{route('admin.product.update',$product->id)}}" method="Post" enctype="multipart/form-data">
                @csrf


                          <div class="form-group">
                               <label for="exampleInputPassword1">Title</label>
                               <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" required value="{{$product->title}}">


                                @error('title')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>


                          <div class="form-group" >
                            
                            Old Images <br>

                            @foreach(explode("|",$product->images) as $image)
                            <img src="{{URL::to($image)}}" style="width:100px; height:100px;">
                            @endforeach <br>
                            <label>Add new Images (maximus 3)</label><br>
                            <input type="file" name="images[]" class="form-control @error('images') is-invalid @enderror" multiple>
                          </div>

                              @error('images')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror


                            <div class="form-group">
                               <label>Description</label>
                               <textarea name="description" class="form-control @error('description') is-invalid @enderror" required >{{$product->description}}</textarea>


                                @error('description')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                             

                              <div class="form-group">
                               <label for="exampleInputPassword1">Price</label>
                               <input type="number" class="form-control @error('price') is-invalid @enderror" name="price"  required value="{{$product->price}}" >

                               @error('price')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror
                             </div>

                             <div class="form-group">
                               <label>Category</label>
                               <select class="form-control @error('category_id') is-invalid @enderror" name="category_id">
                                 <option value="">Please select a Category</option>
                                 @foreach(App\Models\Category::get() as $category)
                                  <option value="{{$category->id}}" {{$category->id==$product->category->id ? 'selected' : ''}} >{{$category->name}}</option>
                                 @endforeach
                               </select>
                               @error('category_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                             </div>

                             @if($product->category_id && $product->category->type == 2)
                             <div class="form-group">
                               <label>Brand</label>
                               <select class="form-control @error('brand_id') is-invalid @enderror" name="brand_id">
                                 <option value="">Please select a Brand</option>
                                 @foreach(App\Models\Brand::get() as $brand)
                                  <option value="{{$brand->id}}" {{$brand->id==$product->brand->id ? 'selected' : ''}} >{{$brand->name}}</option>
                                 @endforeach
                               </select>
                               @error('brand_id')
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $message }}</strong>
                                  </span>
                              @enderror

                             </div> 
                             @endif                            
                             
                             <div class="form-check">                             
                             
                            <input type="checkbox" class="form-check-input @error('sale') is-invalid @enderror" name="sale" value="1" {{$product->sale == 1 ? 'checked' : ''}} >
                            <label class="form-check-label" for="yesCheck">Sale</label>                             
                                                   
                             </div>

                             <div class="form-check">                             
                             
                            <input type="checkbox" class="form-check-input @error('featured') is-invalid @enderror" name="featured" value="1" {{$product->featured == 1 ? 'checked' : ''}} >
                            <label class="form-check-label" for="yesCheck">Featured</label>                             
                                                   
                             </div>                              

                               

                                                                                                    
                                          
                        
                             <button type="submit" class="btn btn-success btn-block">Update</button>
               </form>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div>

        


        <a id="delete" href="{{route('admin.product.delete',['id'=> $product->id,'identity' => $product->identity])}}"><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="red" class="bi bi-trash-fill" viewBox="0 0 16 16">
              <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1H2.5zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5zM8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5zm3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0z"/>
            </svg></a>
        
             

  <a data-toggle="modal" data-target="#modal-default2{{$product->id}}" href=""><svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="orange" class="bi bi-folder2-open" viewBox="0 0 16 16">
  <path d="M1 3.5A1.5 1.5 0 0 1 2.5 2h2.764c.958 0 1.76.56 2.311 1.184C7.985 3.648 8.48 4 9 4h4.5A1.5 1.5 0 0 1 15 5.5v.64c.57.265.94.876.856 1.546l-.64 5.124A2.5 2.5 0 0 1 12.733 15H3.266a2.5 2.5 0 0 1-2.481-2.19l-.64-5.124A1.5 1.5 0 0 1 1 6.14V3.5zM2 6h12v-.5a.5.5 0 0 0-.5-.5H9c-.964 0-1.71-.629-2.174-1.154C6.374 3.334 5.82 3 5.264 3H2.5a.5.5 0 0 0-.5.5V6zm-.367 1a.5.5 0 0 0-.496.562l.64 5.124A1.5 1.5 0 0 0 3.266 14h9.468a1.5 1.5 0 0 0 1.489-1.314l.64-5.124A.5.5 0 0 0 14.367 7H1.633z"/>
</svg></a>
<a data-toggle="modal" data-target="#modal-default3{{$product->id}}" href="">
<svg xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-plus-square-dotted" viewBox="0 0 16 16">
  <path d="M2.5 0c-.166 0-.33.016-.487.048l.194.98A1.51 1.51 0 0 1 2.5 1h.458V0H2.5zm2.292 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zm1.833 0h-.916v1h.916V0zm1.834 0h-.917v1h.917V0zm1.833 0h-.917v1h.917V0zM13.5 0h-.458v1h.458c.1 0 .199.01.293.029l.194-.981A2.51 2.51 0 0 0 13.5 0zm2.079 1.11a2.511 2.511 0 0 0-.69-.689l-.556.831c.164.11.305.251.415.415l.83-.556zM1.11.421a2.511 2.511 0 0 0-.689.69l.831.556c.11-.164.251-.305.415-.415L1.11.422zM16 2.5c0-.166-.016-.33-.048-.487l-.98.194c.018.094.028.192.028.293v.458h1V2.5zM.048 2.013A2.51 2.51 0 0 0 0 2.5v.458h1V2.5c0-.1.01-.199.029-.293l-.981-.194zM0 3.875v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 5.708v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zM0 7.542v.916h1v-.916H0zm15 .916h1v-.916h-1v.916zM0 9.375v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .916v.917h1v-.917H0zm16 .917v-.917h-1v.917h1zm-16 .917v.458c0 .166.016.33.048.487l.98-.194A1.51 1.51 0 0 1 1 13.5v-.458H0zm16 .458v-.458h-1v.458c0 .1-.01.199-.029.293l.981.194c.032-.158.048-.32.048-.487zM.421 14.89c.183.272.417.506.69.689l.556-.831a1.51 1.51 0 0 1-.415-.415l-.83.556zm14.469.689c.272-.183.506-.417.689-.69l-.831-.556c-.11.164-.251.305-.415.415l.556.83zm-12.877.373c.158.032.32.048.487.048h.458v-1H2.5c-.1 0-.199-.01-.293-.029l-.194.981zM13.5 16c.166 0 .33-.016.487-.048l-.194-.98A1.51 1.51 0 0 1 13.5 15h-.458v1h.458zm-9.625 0h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zm1.834-1v1h.916v-1h-.916zm1.833 1h.917v-1h-.917v1zm1.833 0h.917v-1h-.917v1zM8.5 4.5a.5.5 0 0 0-1 0v3h-3a.5.5 0 0 0 0 1h3v3a.5.5 0 0 0 1 0v-3h3a.5.5 0 0 0 0-1h-3v-3z"/>
</svg></a>
        <!--product add stock modal-->
      <div class="modal fade" id="modal-default3{{$product->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">Update stock</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header"><h2>{{$product->title}}</h2></div>
                 <div class="card-body">
                  <h4>Please check available weights</h4>
                  @foreach($product->productweight as $wgt)
                           <form action="{{route('admin.product.stock.update',$wgt->id)}}" class="wgt" method="POST">
                            @csrf
                            @if(!is_null($wgt->brand_id))<input type="hidden" name="brand_id" value="{{$wgt->brand->id}}">@endif

                            @if($wgt->product->category->type == 2)
                            <div class="form-check">                             
                             
                            <input style="width: 59px;" type="number" class="form-check-input" name="quantity" id="number" value="{{$wgt->quantity}}" min="0" >
                            <label style="margin-left: 46px;" class="form-check-label" for="quantity">{{$wgt->measurement->weight}}</label>

                              @if($wgt->quantity > 0)<span style="margin-left: 3px" id="span{{$wgt->id}}" class="btn btn-success"> {{$wgt->quantity}} pieces available </span> @else <span style="margin-left: 3px" id="span{{$wgt->id}}" class="btn btn-warning"> currently unvailable </span> @endif
                                                   
                             </div>
                             @else

                             <div class="form-check">                             
                             
                            <input type="checkbox" class="form-check-input" name="availability" id="Check" value="1" {{$wgt->availability == 1 ? 'checked' : ''}}>
                            <label class="form-check-label" for="yesCheck">{{$wgt->measurement->weight}}</label>

                              @if($wgt->availability == 1)<span id="span{{$wgt->id}}" class="btn btn-success"> Available </span> @else <span id="span{{$wgt->id}}" class="btn btn-warning"> Currently available </span> @endif
                                                   
                             </div>                                
                             @endif                                                                                                       
                            
                             <button type="submit" class="btn btn-success">update</button><p id="notice{{$wgt->id}}" style="display: none;" class="text-success"> </p>
                           </form>
                           <br> 
                   
                           <br>
                    @endforeach        

                       
                           
                            
                 </div>
               </div>
            </div>
          </div>
          <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
      </div> 
        <!--product view modal-->
      <div class="modal fade" id="modal-default2{{$product->id}}">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title">View product</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

            <div class="modal-body">
               <div class="card">
                 <div class="card-header"><h2>{{$product->title}}</h2></div>
                 <div class="card-body">
        <div id="carouselExampleControls{{$product->id}}" class="carousel slide" data-ride="carousel">
          <div class="carousel-inner">

            @foreach(explode("|",$product->images) as $image)
            <div class="carousel-item {{ $loop->first ? 'active' : '' }}">
              <img class="d-block w-100" src="{{URL::to($image)}}" style="width:700px; height:700px;" alt="First slide">
            </div>
            @endforeach
         
          </div>
          <a class="carousel-control-prev" href="#carouselExampleControls{{$product->id}}" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls{{$product->id}}" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
          </a>
        </div>
          <div class="container">
            <div class="row">
              <div class="details">
                <ul>
                  <li><strong>Slug: </strong>{{$product->slug}}</li>
                  <li><strong>Price: </strong>{{$product->price}} ৳</li>
                  <li><strong>Availability: </strong>@if($product->quantity > 0){{$product->quantity}}@else<p class="bg-danger">Out of Stock</p>@endif</li>
                  
                </ul>
              </div>
            </div>
          </div>
              <h4><strong>Description</strong></h4>
                   <p class="card-footer">{{$product->description}}</p>
                 </div>
               </div>
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