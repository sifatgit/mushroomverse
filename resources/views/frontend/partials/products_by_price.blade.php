@foreach($products_by_price as $product)
                                    	@if($product->category->type==2)
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        @if($product->sale == 1)<p class="sale">Sale</p>@endif
                                                    </div>
                                                    @php $images = explode("|",$product->images) @endphp
                                                    @php $wishlist = App\Models\Wishlist::where('product_id',$product->id)->where('ip_address',request()->ip())->first(); @endphp                                                    
                                                    <img src="{{URL::to($images[0])}}" class="img-fluid" alt="Image">
                                                    <div class="mask-icon">
                                                        <ul>
                                                            <li><a href="{{route('product.view',$product->id)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                            <li><a class="addtowish" href="{{route('wishlist.store',$product->id)}}" data-toggle="tooltip" data-placement="right" title="Add to Wishlist">@if($wishlist)<i class="fas fa-heart"></i>@else <i class="far fa-heart"></i> @endif</a></li>
                                                        </ul>
                                @php $quantities = App\Models\ProductWeight::where('product_id',$product->id)->where('quantity','>', 0)->get() @endphp
                                @if(count($quantities) > 0)                                                         
                                <form class="cartstore" action="{{route('cart.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <input id="product_id" type="hidden" name="product_id" value="{{$product->id}}">
                                
                                <input id="brand_id" type="hidden" name="brand_id" value="{{$product->brand->id}}">
                                
                                
                                <select class="btn weight-dropdown" name="measurement_id" required>
                                <option value="">Select a weight</option>
                                @foreach($product->productweight as $wgt)
                                @if($wgt->quantity > 0)
                                <option data-id="{{$wgt->id}}" value="{{$wgt->measurement->id}}">{{$wgt->measurement->weight}}</option>
                                @endif
                                @endforeach
                                </select><br>
                                <input type="hidden" name="productweight_id" value="0" class="productweight_id{{$product->id}}" required>
                                <button class="btn btn-default" type="submit">Add to cart</button> 
                                </form>
                                @endif
                                                    </div>
                                                </div>
                                                <div class="why-text">
                                                    <h4>{{$product->title}}</h4>
                                                    <h5 class="product-price{{$product->id}}">Tk {{$product->price}}</h5>
                                                 
                            @if(count($quantities) > 0)
                            <span class="btn bg-success text-light" > Available </span>
                            @else
                            <span class="btn bg-warning"> Out of stock </span>
                            @endif                    
                                                </div>
                                            </div>
                                        </div>
                                        @else
                                        <div class="col-sm-6 col-md-6 col-lg-4 col-xl-4">
                                            <div class="products-single fix">
                                                <div class="box-img-hover">
                                                    <div class="type-lb">
                                                        @if($product->sale == 1)<p class="sale">Sale</p>@endif
                                                    </div>
                                                    @php $images = explode("|",$product->images) @endphp
                                                    @php $wishlist = App\Models\Wishlist::where('product_id',$product->id)->where('ip_address',request()->ip())->first(); @endphp
                                                    <img src="{{URL::to($images[0])}}" class="img-fluid" alt="Image">
                                                    <div class="mask-icon">
                                                        <ul>
                                                            <li><a href="{{route('product.view',$product->id)}}" data-toggle="tooltip" data-placement="right" title="View"><i class="fas fa-eye"></i></a></li>
                                                            <li><a href="#" data-toggle="tooltip" data-placement="right" title="Compare"><i class="fas fa-sync-alt"></i></a></li>
                                                            <li><a class="addtowish" href="{{route('wishlist.store',$product->id)}}" data-toggle="tooltip" data-placement="right" title="Add to Wishlist">@if($wishlist)<i class="fas fa-heart"></i>@else <i class="far fa-heart"></i> @endif</a></li>
                                                        </ul>
                                @php $availability = App\Models\ProductWeight::where('product_id',$product->id)->where('availability', 1)->get(); @endphp
                                @if(count($availability) > 0)
                                <form class="cartstore" action="{{route('cart.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <input type="hidden" name="product_id" value="{{$product->id}}">
                                @if($product->brand_id)
                                <input type="hidden" name="brand_id" value="{{$product->brand->id}}">
                                @endif
                                <select class="btn weight-dropdown" name="measurement_id" required>
                                <option value="" >Select a weight</option>
                                @foreach($product->productweight as $wgt)
                                @if($wgt->availability > 0)
                                <option data-id="{{$wgt->id}}" value="{{$wgt->measurement->id}}">{{$wgt->measurement->weight}}</option>
                                @endif
                                @endforeach
                                </select><br>
                                <input type="hidden" name="productweight_id" value="0" class="productweight_id{{$product->id}}" required>
                                <button class="btn btn-default" type="submit">Add to cart</button> 
                                </form>
                                @endif
                                                    </div>
                                                </div>
                                                <div class="why-text">
                                                    <h4>{{$product->title}}</h4>
                                                    <h5 class="product-price{{$product->id}}">Tk {{$product->price}}</h5>
                            
                            @if(count($availability) > 0)
                            <span class="btn bg-success text-light" > Available </span>
                            @else
                            <span class="btn bg-warning"> Out of stock </span>
                            @endif                      
                                                </div>
                                            </div>
                                        </div>
                                        @endif                                        
                                        @endforeach