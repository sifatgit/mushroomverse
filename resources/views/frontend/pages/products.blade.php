@extends('frontend.layouts.app')
@section('content')
    <!-- Start All Title Box -->
    <div class="all-title-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <h2>Shop</h2>
                    <ul class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('/')}}">Home</a></li>
                        <li class="breadcrumb-item active">Shop</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End All Title Box -->

    <!-- Start Shop Page  -->
    <div class="shop-box-inner">
        <div class="container">
            <div class="row">
                <div class="col-xl-9 col-lg-9 col-sm-12 col-xs-12 shop-content-right">
                    <div class="right-product-box">
                        <div class="product-item-filter row">
                            <div class="col-12 col-sm-8 text-center text-sm-left">
                                <div class="toolbar-sorter-right">
                                    <span>Sort by </span>
@php
    $sort_option = $sort_option ?? 'nothing'; // Default value is 'nothing'
@endphp
<form id="sortForm" action="{{ route('products.sort') }}" method="GET">
    <input type="hidden" name="products" value="{{ json_encode($products->pluck('id')->toArray()) }}">

    <select id="sortOption" name="sort_option" class="selectpicker show-tick form-control" onchange="product_sort_filter()">
        <option value="nothing" {{ $sort_option == 'nothing' ? 'selected' : '' }}>Nothing</option>
        <option value="high_price" {{ $sort_option == 'high_price' ? 'selected' : '' }}>High Price → Low Price</option>
        <option value="low_price" {{ $sort_option == 'low_price' ? 'selected' : '' }}>Low Price → High Price</option>
    </select>
</form>














                                </div>
                                <p id="product-head">Showing all results</p>
                            </div>
                            <div class="col-12 col-sm-4 text-center text-sm-right">
                                <ul class="nav nav-tabs ml-auto">
                                    <li>
                                        <a class="nav-link active" href="#grid-view" data-toggle="tab"> <i class="fa fa-th"></i> </a>
                                    </li>
                                    <li>
                                        <a class="nav-link" href="#list-view" data-toggle="tab"> <i class="fa fa-list-ul"></i> </a>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="product-categorie-box">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane fade show active" id="grid-view">
                                    <div class="row" id="product-list-container">
                                    	@foreach($products as $product)
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
                                
                                @if($product->brand_id)
                                <input id="brand_id" type="hidden" name="brand_id" value="{{$product->brand->id}}">
                                @endif
                                
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
                                                    <h5 class="product-price{{$product->id}}"> Tk {{$product->price}}</h5>
                                                            
                                                 
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
                                                    <h5 class="product-price{{$product->id}}"> Tk {{$product->price}}</h5>
                              
                            
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
                                </div>
                                <div role="tabpanel" class="tab-pane fade product-list-container_2" id="list-view">
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
                                                    <h5 class="product-price-list{{$product->id}} text-light"> <!--<del>$ 60.00</del>--> Tk {{$product->price}}</h5>
                                                    <p>{{$product->description}}</p>
                            @php $quantities = App\Models\ProductWeight::where('product_id',$product->id)->where('quantity','>', 0)->get() @endphp                
                            @if(count($quantities) > 0)
                            <span class="btn bg-success text-light" > Available </span>
                            @else
                            <span class="btn bg-warning"> Out of stock </span>
                            @endif
                                @if(count($quantities) > 0)
                                <form class="cartstore" action="{{route('cart.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <input id="product_id" type="hidden" name="product_id" value="{{$product->id}}">
                                
                                @if($product->brand_id)
                                <input id="brand_id" type="hidden" name="brand_id" value="{{$product->brand->id}}">
                                @endif
                                
                                
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
                                                                <li><a href="#" data-toggle="tooltip" data-placement="right" title="Add to Wishlist">@if(!is_null($product->wishlist))<i class="fas fa-solid fa-heart"></i>@else <i class="far fa-solid fa-heart"></i> @endif</a></li>
                                                            </ul>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6 col-md-6 col-lg-8 col-xl-8">
                                                <div class="why-text full-width">
                                                    <h4>{{$product->title}}</h4>
                                                    <h5 class="product-price-list{{$product->id}} text-light"> <!--<del>$ 60.00</del>--> Tk {{$product->price}}</h5>
                                                    <p>{{$product->description}}</p>
                            <br>
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
                                </div>
                            </div>
                            <div id="pagination_links">   
                                {{ $products->links() }}
                            </div>
                            <div id="pagination_links_price">
                                
                            </div>
                            
                        </div>
                    </div>
                </div>
				<div class="col-xl-3 col-lg-3 col-sm-12 col-xs-12 sidebar-shop-left">
                    <div class="product-categori">
                        <div class="search-product">
                            <form action="#">
                                <input class="form-control" placeholder="Search here..." type="text">
                                <button type="submit"> <i class="fa fa-search"></i> </button>
                            </form>
                        </div>
                        <div class="filter-sidebar-left">
                            <div class="title-left">
                                <h3>Categories</h3>
                            </div>
                            <div class="list-group list-group-collapse list-group-sm list-group-tree" id="list-group-men" data-children=".sub-men">
                                
                                @foreach(App\Models\Category::get() as $category)
                                <a href="{{route('category.products',$category->id)}}" class="list-group-item list-group-item-action"> {{$category->name}}  <small class="text-muted">({{count($category->products)}}) </small></a>
                                @endforeach
                            </div>
                        </div>
                        <div class="filter-price-left">
                            <div class="title-left">
                                <h3>Price</h3>
                            </div>
                    @php $minPrice = App\Models\Product::min('price'); @endphp
                    @php $maxPrice = App\Models\Product::max('price'); @endphp

                <div class="price-box-slider">
                <form id="price-filter-form" action="{{ route('product.price_filter') }}" method="GET">
                    <div id="slider-range" style="width: 100%; height: 10px; background-color: #ddd; position: relative;"></div>
                    <p>
                        <input type="text" id="amount" readonly style="border:0; color:#0a434d; font-weight: bold;">
                        @if($minPrice)
                        <input type="hidden" name="min_price" id="min_price" value="{{ $minPrice}}">
                        @else
                        <input type="hidden" name="min_price" id="min_price" value="0">                     
                        @endif

                        @if($maxPrice)
                        <input type="hidden" name="max_price" id="max_price" value="{{ $maxPrice}}">
                        @else
                        <input type="hidden" name="max_price" id="max_price" value="10000">                        
                        @endif
                        <button class="btn hvr-hover" type="submit">Filter</button>
                    </p>
                </form>

                </div>


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Shop Page -->


@endsection