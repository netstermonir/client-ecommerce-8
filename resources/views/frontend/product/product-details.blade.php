@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
@include('layouts.front-partial.collapse')
@php
	$review_5 = App\Models\Review::where('product_id', $productdetails->id)->where('rating', 5)->count();
	$review_4 = App\Models\Review::where('product_id', $productdetails->id)->where('rating', 4)->count();
	$review_3 = App\Models\Review::where('product_id', $productdetails->id)->where('rating', 3)->count();
	$review_2 = App\Models\Review::where('product_id', $productdetails->id)->where('rating', 2)->count();
	$review_1 = App\Models\Review::where('product_id', $productdetails->id)->where('rating', 1)->count();
	$sum_rating = App\Models\Review::where('product_id', $productdetails->id)->sum('rating');
	$count_rating=App\Models\Review::where('product_id',$productdetails->id)->count('rating');

		// socaial share
	// Share button 1
   $shareButtons1 = \Share::page(
         url()->current()
   )
   ->facebook()
   ->twitter()
   ->linkedin()
   ->telegram()
   ->whatsapp() 
   ->reddit();
@endphp
	<!-- Single Product -->

	<div class="single_product">
		<div class="container">
			<div class="row">
				@php
					$images = json_decode($productdetails->images, true);
					$color=explode(',',$productdetails->color);
			 		$sizes=explode(',',$productdetails->size);
				@endphp
				<!-- /images -->
				<div class="col-lg-2 order-lg-1 order-2">
					<ul class="image_list">
						<li data-image="{{ asset('public/files/product/'.$productdetails->thumbnail) }}"><img src="{{ asset('public/files/product/'.$productdetails->thumbnail) }}" alt="{{ $productdetails->name }}">
						</li>
						@isset($images)
						@foreach($images as $key => $image)
						<li data-image="{{ asset('public/files/product/'.$image) }}"><img src="{{ asset('public/files/product/'.$image) }}" alt="{{ $productdetails->name }}">
						</li>
						@endforeach
						@endisset
					</ul>
				</div>

				<!-- Selected Image -->
				<div class="col-lg-5 order-lg-2 order-1">
					<div class="image_selected"><img src="{{ asset('public/files/product/'.$productdetails->thumbnail) }}" alt="{{ $productdetails->name }}"></div>
				</div>

				<!-- Description -->
				<div class="col-lg-5 order-3">
					<div class="social-btn-sp product_description pb-3">
                     	{!! $shareButtons1 !!}
               		</div> 
					<div class="product_description">
						<div class="product_category"><b>Category: </b>{{ $productdetails->category->category_name }}
							@if($productdetails->subcategory->subcat_name || $productdetails->childcategory->childcategory_name)
								→{{ $productdetails->subcategory->subcat_name }}
								→{{ $productdetails->childcategory->childcategory_name }}
							@endif
						</div>
						<div class="product_name">{{ $productdetails->name }}</div>
						<div class="product_category">
							@if($productdetails->brand->brand_name)
								<b>Brand:→</b> {{ $productdetails->brand->brand_name }}
							@endif
							@if($productdetails->warehouses_id !== Null)
								<b>Warehouse:→</b> {{ $productdetails->warehouses->warehouse_name }}
							@endif
						</div>
						<div class="rating_r rating_r_4 product_rating">
							@if($sum_rating !=NULL)
						 	@if(intval($sum_rating/$count_rating) == 5)
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	@elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star "></span>
						 	@elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	@elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	@else
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	@endif
						@endif
						</div>
						<div class="product_category">
							@if($productdetails->stock_quantity || $productdetails->unit)
								<b>Stock: </b>{{ $productdetails->stock_quantity }}
								→<b>Unit: </b>{{ $productdetails->unit }}
							@endif
						</div>
						@if($productdetails->discount_price == Null)
                            <div class="product_price">{{ $setting->currency }}{{ $productdetails->selling_price }}</div>
                            @else
                                <div class="product_price">
                                	<del class="text-danger" style="font-size:12px;">{{ $setting->currency }}{{ $productdetails->selling_price }}</del>
                                	{{ $setting->currency }}{{ $productdetails->discount_price }}
                                </div>
                        @endif
						{{-- <div class="product_text"><p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas fermentum. laoreet turpis, nec sollicitudin dolor cursus at. Maecenas aliquet, dolor a faucibus efficitur, nisi tellus cursus urna, eget dictum lacus turpis.</p></div> --}}
						<div class="order_info d-flex flex-row">
							<form action="{{ route('add.to.cart.quickview') }}" method="post" id="add_cart_details_form">
								@csrf
								<input type="hidden" name="id" value="{{ $productdetails->id }}">
								@if($productdetails->discount_price==NULL)
			                      <input type="hidden" name="price" value="{{$productdetails->selling_price}}">
			                      @else
			                      <input type="hidden" name="price" value="{{$productdetails->discount_price}}">
			                    @endif
								<div class="row">
									@isset($productdetails->color)
								    <div class="form-group col-md-6">
								      	<!-- Product Color -->
										<label class="ml-2">Pick Color: </label>
											<select class="custom-select form-control-sm" name="color" style="min-width: 120px;">
												@foreach($color as $colors)
												   <option value="{{ $colors }}">{{ $colors }}</option>
												@endforeach
											</select>
								    </div>
								    @endisset
								    @isset($productdetails->size)
								    	<div class="form-group col-md-6">
								      		<!-- Product Size -->
										<label class="ml-2">Pick Size: </label>
											<select class="custom-select form-control-sm" name="size" style="min-width: 120px;">

												@foreach($sizes as $size)
												   <option value="{{ $size }}">{{ $size }}</option>
												@endforeach

											</select>
								    	</div>
								    @endisset
								</div>
								<div class="clearfix ml-2" style="z-index: 1000;">
									<!-- Product Quantity -->
									<div class="product_quantity clearfix">
										<span>Quantity: </span>
										<input id="quantity_input" type="text" name="qty" pattern="[1-9]*" value="1">
										<div class="quantity_buttons">
											<div id="quantity_inc_button" class="quantity_inc quantity_control">
												<i class="fas fa-chevron-up"></i>
											</div>
											<div id="quantity_dec_button" class="quantity_dec quantity_control">
												<i class="fas fa-chevron-down"></i>
											</div>
										</div>
									</div>
								</div>

								<div class="button_container">
									@if($productdetails->stock_quantity<1)
	                              	<span class="text-danger">Stock Out</span>
	                              	@else
	                               <button type="submit" class="button cart_button"><span class="loading d-none">....</span>Add to Cart</button>
	                                @endif
									<a class="product_fav_single" title="wishlist" href="{{ route('add.wishlist', $productdetails->id) }}"><i class="far fa-heart"></i></a>
								</div>

							</form>
						</div>
					</div>
				</div>

			</div>
			<div class="row" style="padding-top: 5rem; padding-bottom: 5rem;">
			<div class="col-lg-12">
			<div class="card">
				<div class="card-header">
					<nav>
	                    <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
	                      <a class="nav-item nav-link active" id="nav-home-tab" data-toggle="tab" href="#nav-home" role="tab" aria-controls="nav-home" aria-selected="true">Description</a>
	                      <a class="nav-item nav-link" id="nav-profile-tab" data-toggle="tab" href="#nav-profile" role="tab" aria-controls="nav-profile" aria-selected="false">Video</a>
	                      <a class="nav-item nav-link" id="nav-contact-tab" data-toggle="tab" href="#nav-contact" role="tab" aria-controls="nav-contact" aria-selected="false">Review</a>
	                    </div>
	                </nav>
				</div>
				<div class="card-body">
					<div class="tab-content py-3 px-3 px-sm-0" id="nav-tabContent">
	                    <div class="tab-pane fade show active" id="nav-home" role="tabpanel" aria-labelledby="nav-home-tab">
	                      <h4 style="padding-bottom: 10px;">Product details of : <span style="color:gray;">{{ $productdetails->name }}</span></h4>
							 {!! $productdetails->description !!}
	                    </div>
	                    <div class="tab-pane fade" id="nav-profile" role="tabpanel" aria-labelledby="nav-profile-tab">
	                    	@if($productdetails->video)
	                    	<h4 class="text-center" style="padding-bottom: 10px;">Product Video of : <span style="color:gray;">{{ $productdetails->name }}</span></h4>
							 <div class="text-center video">
							 	{!! $productdetails->video !!}
							 </div>
							 @else
							 	<h4 class="text-center" style="padding-bottom: 10px;">Product Video Not Found.</h4>
							 @endif
                    	</div>
                    	<div class="tab-pane fade" id="nav-contact" role="tabpanel" aria-labelledby="nav-contact-tab">
	                    	<div class="row">
			<div class="col-lg-12">
			 <div class="card">
			  <div class="card-header">
				<h4>Ratings & Reviews of : {{ $productdetails->name }} </h4>
			  </div>



				<div class="card-body">
					<div class="row">
						<div class="col-lg-3">
							Average Review of  :<br>

						@if($sum_rating !=NULL)
						 	@if(intval($sum_rating/$count_rating) == 5)
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	@elseif(intval($sum_rating/$count_rating) >= 4 && intval($sum_rating/5) <$count_rating)
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star "></span>
						 	@elseif(intval($sum_rating/$count_rating) >= 3 && intval($sum_rating/5) <$count_rating)
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	@elseif(intval($sum_rating/$count_rating) >= 2 && intval($sum_rating/5) <$count_rating)
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	@else
						 	<span class="fa fa-star checked"></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	<span class="fa fa-star "></span>
						 	@endif
						@endif
						</div>
						<div class="col-md-3">

							{{-- all review show --}}
							Total Review Of This Product:<br>
						 	 		  <div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span> Total: ({{ $review_5 }}) </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span> Total: ({{ $review_4 }}) </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span> Total: ({{ $review_3 }}) </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span> Total: ({{ $review_2 }}) </span>
										</div>

										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span class="fa fa-star "></span>
											<span> Total: ({{ $review_1 }}) </span>
										</div>


						</div>
						<div class="col-lg-6">
							<form action="{{ route('review.store') }}" method="post">
								@csrf
							  <div class="form-group">
							    <label for="details">Write Your Review</label>
							    <textarea type="text" class="form-control" name="review" required=""></textarea>
							  </div>
								<input type="hidden" name="product_id" value="{{ $productdetails->id }}">
							  <div class="form-group ">
							    <label for="review">Write Your Review</label>
							     <select class="custom-select form-control-sm" name="rating" style="min-width: 120px;">
							     	<option disabled="" selected="">Select Your Review</option>
							     	<option value="1">1 star</option>
							     	<option value="2">2 star</option>
							     	<option value="3">3 star</option>
							     	<option value="4">4 star</option>
							     	<option value="5">5 star</option>
							     </select>

							  </div>
							  @if(Auth::check())
							  <button style="cursor: pointer;" type="submit" class="btn btn-sm btn-info"><span class="fa fa-star "></span> submit review</button>
							  @else
							   <p>Please at first login to your account for submit a review.</p>
							  @endif
							</form>
						</div>
					</div>
						<br>

					{{-- all review of this product --}}
						<strong>All review of : {{ $productdetails->name }}</strong> <hr>
					<div class="row">
						@foreach($review as $row)
							<div class="card col-lg-5 m-2">
						 	 <div class="card-header">
						 	 	{{ $row->user->name }}	({{ date('d F, Y'), strtotime($row->review_date) }})
						 	 </div>
							 	<div class="card-body">
							 	 	{{ $row->review }}
					 	 		  	@if($row->rating == 5)
						 	 		  	<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											@if($row->rating == 5)
												<span>(5)</span>
											@endif
										</div>
									@elseif($row->rating == 4)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											@if($row->rating == 4)
												<span>(4)</span>
											@endif
										</div>
									@elseif($row->rating == 3)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											@if($row->rating == 3)
												<span>(3)</span>
											@endif
										</div>
									@elseif($row->rating == 2)
										<div>
											<span class="fa fa-star checked"></span>
											<span class="fa fa-star checked"></span>
											@if($row->rating == 2)
												<span>(2)</span>
											@endif
										</div>
									@elseif($row->rating == 1)
										<div>
											<span class="fa fa-star checked"></span>
											@if($row->rating == 1)
												<span>(1)</span>
											@endif
										</div>
									@endif
							 	</div>
						 </div>
					  @endforeach
					</div>
				</div>


			 </div>
			</div>
		</div>
                    	</div>
				 	</div>
      			</div>
			</div>
			</div>
		</div><br>

		</div>
	</div>

	<!-- Recently Viewed -->

	<div class="viewed">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="viewed_title_container">
						<h3 class="viewed_title">Related Product</h3>
						<div class="viewed_nav_container">
							<div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
							<div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
						</div>
					</div>

					<div class="viewed_slider_container">

						<!-- Recently Viewed Slider -->
						<div class="owl-carousel owl-theme viewed_slider">
							@foreach($related_product as $row)
							<!-- Recently Viewed Item -->
							<div class="owl-item">
								<div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
									<div class="viewed_image"><img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="{{ $row->name }}"></div>
									<div class="viewed_content text-center">
										@if($row->discount_price==NULL)
								             <div class="viewed_price">{{ $setting->currency }}{{ $row->selling_price }}</div>
								            @else
								             <div class="viewed_price">{{ $setting->currency }}{{ $row->discount_price }} <span>{{ $setting->currency }}{{ $row->selling_price }}</span></div>
							            @endif
										<div class="viewed_name"><a href="{{ route('product.details', $row->slug) }}">{{ substr($row->name, 0,18) }}</a></div>
									</div>
									<ul class="item_marks">
										<li class="item_mark item_discount">new</li>
									</ul>
								</div>
							</div>
							@endforeach
						</div>

					</div>
				</div>
			</div>
		</div>
	</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
  //store coupon ajax call
  $('#add_cart_details_form').submit(function(e){
    e.preventDefault();
    $('.loading').removeClass('d-none');
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
        $('#add_cart_details_form')[0].reset();
        $('.loading').addClass('d-none');
        Cart();
      }
    });
  });
</script>
@endsection
