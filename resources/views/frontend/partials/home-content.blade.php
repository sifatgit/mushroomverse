    <!-- Start Slider -->
    <div id="slides-shop" class="cover-slides">
        <ul class="slides-container">
            @foreach(App\Models\Slider::orderBy('id','asc')->get() as $slider)
            <li class="text-center">
                <img style="width: 1920px; height: 1080px;" src="{{URL::to($slider->image)}}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>{{$slider->title}}</strong></h1>
                            <p class="m-b-40">{{$slider->text}}</p>
                            <p><a class="btn hvr-hover" href="{{route('products')}}">Shop Now</a></p>
                        </div>
                    </div>
                </div>
            </li>
            @endforeach
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End Slider -->

    <!-- Start Categories  -->
    <div class="categories-shop">
        <div class="container">
            <div class="row">
                @foreach(App\Models\Category::get() as $cat)
                <div class="col-lg-4 col-md-4 col-sm-12 col-xs-12">
                    <div class="shop-cat-box">
                        <img class="img-fluid" src="{{URL::to($cat->image)}}" alt="" />
                        <a class="btn hvr-hover" href="{{route('category.products',$cat->id)}}">{{$cat->name}}</a>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Categories -->
	
	

    <!-- Start Products  -->
    <div class="products-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>Mushrooms</h1>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed sit amet lacus enim.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All</button>
                            @foreach(App\Models\Category::get() as $category)
                            <button data-filter=".{{$category->id}}">{{$category->name}}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row special-list">
                @foreach(App\Models\Product::limit(8)->get() as $product)
                @if($product->category->type==2) 
                <div class="col-lg-3 col-md-6 special-grid {{$product->category->id}}">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                @if($product->sale == 1)<p class="sale">Sale</p>@endif
                            </div>
                            @php $images = explode("|", $product->images) @endphp
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
                                
                                @if($product->brand_id)
                                <input id="brand_id" type="hidden" name="brand_id" value="{{$product->brand->id}}">
                                @endif
                                
                                
                                <select class="weight-dropdown" name="measurement_id" required>
                                <option value="">Select a weight</option>
                                @foreach($product->productweight as $wgt)
                                @if($wgt->quantity > 0)
                                <option data-id="{{$wgt->id}}" value="{{$wgt->measurement->id}}">{{$wgt->measurement->weight}}</option>
                                @endif
                                @endforeach
                                </select>
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
                                <div class="col-lg-3 col-md-6 special-grid {{$product->category->id}}">
                    <div class="products-single fix">
                        <div class="box-img-hover">
                            <div class="type-lb">
                                @if($product->sale == 1)<p class="sale">Sale</p>@endif
                            </div>
                            @php $images = explode("|", $product->images) @endphp
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
                                <select class="weight-dropdown" class="btn" name="measurement_id" required>
                                <option value="" >Select a weight</option>
                                @foreach($product->productweight as $wgt)
                                @if($wgt->availability > 0)
                                <option data-id="{{$wgt->id}}" class="text-center" value="{{$wgt->measurement->id}}">{{$wgt->measurement->weight}}</option>
                                @endif
                                @endforeach
                                </select>
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
            </div>
            @if(count(App\Models\Product::get()) > 4)
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <a class="btn" style="background-color: #0a434d; height: 45px;" href="{{route('products')}}"><h1 class="text-light">All Mushrooms</h1></a>
                    </div>
                </div>                    
            </div>
            @endif
        </div>
    </div>
    <!-- End Products  -->

    <!-- Start Blog  -->
    <div class="latest-blog">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title-all text-center">
                        <h1>latest blogs</h1>
                        <p>Get to read some of the most informational blogs.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                @foreach(App\Models\Blog::get() as $blog)
                <div class="col-md-6 col-lg-4 col-xl-4">
                    <div class="blog-box">
                        <div class="blog-img">
                            <img class="img-fluid" src="{{URL::to($blog->image)}}" alt="" />
                        </div>
                        <div class="blog-content">
                            <div class="title-blog">
                                <h3>{{$blog->title}}</h3>
                                <p>{{ Str::limit($blog->details, 100) }}</p>
                                <a class="btn hvr-hover text-light" href="{{route('blog.view',$blog->id)}}">Read More</a>
                            </div>
                            <ul class="option-blog">
                                
                                <li><a href="{{route('blog.view',$blog->id)}}"><i class="fas fa-eye"></i></a></li>
                                
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Blog  -->


    
