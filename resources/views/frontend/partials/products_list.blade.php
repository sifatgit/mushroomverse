@foreach($products as $product)
                                	@if($product->category->type == 2)
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            @if($product->sale == 1)<p class="sale">Sale</p>@endif
                                                        </div>
                                                        @php $images = explode("|",$product->images) @endphp
                                                        <img src="{{URL::to($images[0])}}" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist">@if(!is_null($product->wishlist))<i class="fas fa-solid fa-heart"></i>@else <i class="far fa-solid fa-heart"></i> @endif</a></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4>{{$product->title}}</h4>
                                                    <h5 class="product-price-list{{$product->id}} text-light"> <!--<del>$ 60.00</del>-->Tk {{$product->price}}</h5>
                                                    <p>{{$product->description}}</p>
                            <strong style="margin-left: 26px;">Brand: </strong><h5 style="float: right;">{{$product->brand->name}}</h5>        <br>
                             @php $quantities = App\Models\ProductWeight::where('product_id',$product->id)->where('quantity','>', 0)->get() @endphp               
                            @if(count($quantities) > 0)
                            <span class="btn bg-success text-light"> Available </span>
                            @else
                            <span class="btn bg-warning"> Out of stock </span>
                            @endif
                                @if(count($quantities) > 0)
                                <form class="cartstore" action="{{route('cart.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <input id="product_id" type="hidden" name="product_id" value="{{$product->id}}">
                                
                                <input id="brand_id" type="hidden" name="brand_id" value="{{$product->brand->id}}">
                                
                                
                                <select class="btn weight-dropdown-list" name="measurement_id" required>
                                <option value="">Select a weight</option>
                                @foreach($product->productweight as $wgt)
                                @if($wgt->quantity > 0)
                                <option data-id="{{$wgt->id}}" value="{{$wgt->measurement->id}}">{{$wgt->measurement->weight}}</option>
                                @endif
                                @endforeach
                                </select><br>
                                <input class="productweight_id-list{{$product->id}}" type="hidden" name="productweight_id" value="" required>
                                <button class="btn hvr-hover text-light" type="submit">Add to cart</button> 
                                </form>
                                @endif
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="list-view-box">
                                        <div class="row">
                                            <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                                <div class="products-single fix">
                                                    <div class="box-img-hover">
                                                        <div class="type-lb">
                                                            @if($product->sale == 1)<p class="sale">Sale</p>@endif
                                                        </div>
                                                        @php $images = explode("|",$product->images) @endphp
                                                        <img src="{{URL::to($images[0])}}" class="img-fluid" alt="Image">
                                                        <div class="mask-icon">
                                                            <ul>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist"><i class="far fa-heart"></i></a></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4>{{$product->title}}</h4>
                                                    <h5 class="product-price-list{{$product->id}} text-light"> <!--<del>$ 60.00</del>-->Tk {{$product->price}}</h5>
                                                    <p>{{$product->description}}</p>
                            @php $availability = App\Models\ProductWeight::where('product_id',$product->id)->where('availability', 1)->get(); @endphp                            
                            @if(count($availability) > 0)
                            <span class="btn bg-success text-light" > Available </span>
                            @else
                            <span class="btn bg-warning"> Out of stock </span>
                            @endif
                                                 
                    
                                @if(count($availability) > 0)
                                <form class="cartstore" action="{{route('cart.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                @if($product->brand_id)
                                <input type="hidden" name="brand_id" value="{{$product->brand->id}}">
                                @endif
                                <select class="btn weight-dropdown-list" name="measurement_id" required>
                                <option value="" >Select a weight</option>
                                @foreach($product->productweight as $wgt)
                                @if($wgt->availability > 0)
                                <option data-id="{{$wgt->id}}" value="{{$wgt->measurement->id}}">{{$wgt->measurement->weight}}</option>
                                @endif
                                @endforeach
                                </select><br>
                                <input class="productweight_id-list{{$product->id}}" type="hidden" name="productweight_id" value="" required>
                                <button class="btn hvr-hover text-light" type="submit">Add to cart</button> 
                                </form>
                                @endif
                                        </div>
                                            </div>
                                        </div>
                                    </div>                                    
                                    @endif
                                    @endforeach