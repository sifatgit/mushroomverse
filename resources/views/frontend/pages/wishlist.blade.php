@extends('frontend.layouts.app')
@section('content')
    <!-- Start Wishlist  -->
    <div class="wishlist-box-main">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="table-main table-responsive">
                                @php $wishlists = App\Models\Wishlist::get(); @endphp
                                @if(count($wishlists) > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Images</th>
                                    <th>Product Name</th>
                                    <th>Unit Price </th>
                                    <th>Stock</th>
                                    <th>Add Item</th>
                                    <th>Remove</th>
                                </tr>
                            </thead>
                            <tbody>

                            	@foreach($wishlists as $wishlist)
                            	
                            	@if($wishlist->category_type == 2)
                                <tr class="wishlist-item{{$wishlist->id}}">
                                    <td class="thumbnail-img">
                                        @if($wishlist->product)
                                        <a href="{{route('product.view',$wishlist->product->id)}}">
                                    @if($wishlist->product_image)
									<img class="img-fluid" src="{{$wishlist->product_image}}" alt="" />
                                    @else
                                    <img class="img-fluid" src="{{asset('public/admin/images/icons/default-image_550.png')}}" alt="" />
                                    @endif
								</a>
                                @else
                                    <a href="#">
                                    
                                    <img class="img-fluid" src="{{asset('public/admin/images/icons/default-image_550.png')}}" alt="" />
                                   
                                </a>                                
                                @endif
                                    </td>
                                    <td class="name-pr">
                                        @if($wishlist->product)
                                        <a href="{{route('product.view',$wishlist->product->id)}}">
                                            @else
                                            <a href="#">
                                            @endif
									{{$wishlist->product_title}}
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p> Tk {{$wishlist->product_price}}</p>
                                    </td>
                                    @php $quantity = 0; @endphp
                                    @if($wishlist->product)
                                    @foreach($wishlist->product->productweight as $stock)
                                    @php $quantity += $stock->quantity; @endphp
                                    @endforeach
                                    @endif
                                    <td class="quantity-box"> @if($quantity > 0) In Stock @else Out of stock @endif</td>
                                    <td class="add-pr">
                                @if($quantity > 0)                                
                                <form class="cartstore" action="{{route('cart.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <input id="product_id" type="hidden" name="product_id" value="{{$wishlist->product->id}}">
                                
                                <input id="brand_id" type="hidden" name="brand_id" value="{{$wishlist->product->brand->id}}">
                                
                                @if($wishlist->product)
                                <select class="cart-list" id="#weight-dropdown" name="measurement_id" required>
                                <option value="">Select a weight</option>
                                @foreach($wishlist->product->productweight as $wgt)
                                @if($wgt->quantity > 0)
                                <option value="{{$wgt->measurement->id}}">{{$wgt->measurement->weight}}</option>
                                @endif
                                @endforeach
                                </select>
                                @endif
                                <br>
                                <button class="cart hvr-hover text-light" type="submit">Add to cart</button> 
                                </form>
                                @else
                                <button disabled class="cart hvr-hover text-light" type="submit">Add to cart</button>
                                @endif
                                    </td>
                                    <td class="remove-pr">
                                        <a class="wishlist" data-id="{{$wishlist->id}}" href="{{route('wishlist.remove',$wishlist->id)}}">
									<i class="fas fa-times"></i>
								</a>
                                    </td>
                                </tr>
                                @else
                                <tr class="wishlist-item{{$wishlist->id}}">
                                    <td class="thumbnail-img">
                                        @if($wishlist->product)
                                        <a href="{{route('product.view',$wishlist->product->id)}}">
                                    @if($wishlist->product_image)
                                    <img class="img-fluid" src="{{$wishlist->product_image}}" alt="" />
                                    @else
                                    <img class="img-fluid" src="{{asset('public/admin/images/icons/default-image_550.png')}}" alt="" />
                                    @endif
								</a>
                                @else
                                        <a href="#">
                                    <img class="img-fluid" src="{{asset('public/admin/images/icons/default-image_550.png')}}" alt="" />
                                </a>                                
                                @endif
                                    </td>
                                    <td class="name-pr">
                                        @if($wishlist->product)
                                        <a href="{{route('product.view',$wishlist->product->id)}}">
                                            @else
                                            <a href="#">
                                            @endif
									{{$wishlist->product_title}}
								</a>
                                    </td>
                                    <td class="price-pr">
                                        <p> Tk {{$wishlist->product_price}}</p>
                                    </td>
                                    @php $quantity = 0; @endphp
                                    @if($wishlist->product)
                                    @foreach($wishlist->product->productweight as $stock)
                                    @php $quantity += $stock->availability; @endphp
                                    @endforeach
                                    @endif
                                    <td class="quantity-box"> @if($quantity > 0) In Stock @else Out of stock @endif</td>
                                    <td class="add-pr">
                                @if($quantity > 0)                                
                                <form class="cartstore" action="{{route('cart.store')}}" method="POST" enctype="multipart/form-data">
                                @csrf  
                                <input id="product_id" type="hidden" name="product_id" value="{{$wishlist->product->id}}">
                                
                                
                                
                                @if($wishlist->product)
                                <select id="#weight-dropdown" name="measurement_id" required>
                                <option value="">Select a weight</option>
                                @foreach($wishlist->product->productweight as $wgt)
                                @if($wgt->availability > 0)
                                <option value="{{$wgt->measurement->id}}">{{$wgt->measurement->weight}}</option>
                                @endif
                                @endforeach
                                </select>
                                @endif
                                <br>
                                <button class="cart hvr-hover text-light" type="submit">Add to cart</button> 
                                </form>
                                @else
                                <button disabled class="cart hvr-hover text-light" type="submit">Add to cart</button>
                                @endif
                                    </td>
                                    <td class="remove-pr">
                                        <a class="wishlist" data-id="{{$wishlist->id}}" href="{{route('wishlist.remove',$wishlist->id)}}">
                                    <i class="fas fa-times"></i>
                                </a>
                                    </td>
                                </tr>                                
                                @endif
                                @endforeach
                                @else
                                <h1 align="center">Your wishlist is empty</h1>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Wishlist -->
@endsection