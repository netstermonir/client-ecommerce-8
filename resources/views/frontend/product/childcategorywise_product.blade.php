@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/shop_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/shop_responsive.css">
@include('layouts.front-partial.collapse')
	<!-- Home -->

	<div class="home">
		<div class="home_background parallax-window" data-parallax="scroll" data-image-src="images/shop_background.jpg"></div>
		<div class="home_overlay"></div>
		<div class="home_content d-flex flex-column align-items-center justify-content-center">
			<h2 class="home_title">{{ $childcat_name->childcategory_name }}</h2>
		</div>
	</div>
<!-- Brands -->

    <div class="brands" style="padding-bottom: 0;">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div style="left: 20px; top: 30px; font-size:16px; font-weight: bold; color: black;">Brand</div>
                    <div class="brands_slider_container">
                        <!-- Brands Slider -->

                        <div class="owl-carousel owl-theme brands_slider">
                            @foreach($brand as $row)
                            <div class="owl-item">
                                <div class="brands_item d-flex flex-column justify-content-center">
                                    <a href="{{ route('brandwise.product', $row->id) }}" title="{{ $row->brand_name }}">
                                        <img src="{{ asset($row->brand_logo) }}" alt="{{ $row->brand_name }}" height="50" width="40">
                                    </a>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        
                        <!-- Brands Slider Navigation -->
                        <div class="brands_nav brands_prev"><i class="fas fa-chevron-left"></i></div>
                        <div class="brands_nav brands_next"><i class="fas fa-chevron-right"></i></div>

                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- Shop -->

	<div class="shop" style="padding-bottom:30px">
		<div class="container">
			<div class="row">
				<div class="col-lg-3">

					<!-- Shop Sidebar -->
					<div class="shop_sidebar">
						<div class="sidebar_section">
							<div class="sidebar_title">Categories</div>
							<ul class="sidebar_categories">
								@foreach($categories as $row)
								<li><a href="{{ route('categorywise.product', $row->id) }}">{{ $row->category_name }}</a></li>
								@endforeach
							</ul>
						</div>
						{{-- <div class="sidebar_section filter_by_section">
							<div class="sidebar_title">Filter By</div>
							<div class="sidebar_subtitle">Price</div>
							<div class="filter_price">
								<div id="slider-range" class="slider_range"></div>
								<p>Range: </p>
								<p><input type="text" id="amount" class="amount" readonly style="border:0; font-weight:bold;"></p>
							</div>
						</div> --}}
	
					</div>

				</div>

				<div class="col-lg-9">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{ count($product) }}</span> products found</div>
							{{-- <div class="shop_sorting">
								<span>Sort by:</span>
								<ul>
									<li>
										<span class="sorting_text">highest rated<i class="fas fa-chevron-down"></span></i>
										<ul>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "original-order" }'>highest rated</li>
											<li class="shop_sorting_button" data-isotope-option='{ "sortBy": "name" }'>name</li>
											<li class="shop_sorting_button"data-isotope-option='{ "sortBy": "price" }'>price</li>
										</ul>
									</li>
								</ul>
							</div> --}}
						</div>

						<div class="product_grid">
							<div class="product_grid_border"></div>
							@foreach($product as $row)
							<!-- Product Item -->
							<div class="product_item is_new">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="{{ $row->name }}"></div>
								<div class="product_content">
									@if($row->discount_price == Null)
                                        <div class="product_price">{{ $setting->currency }}{{ $row->selling_price }}</div>
                                        @else
                                            <div class="product_price">
                                                <del class="text-danger" style="font-size:12px;">{{ $setting->currency }}{{ $row->selling_price }}</del>
                                                {{ $setting->currency }}{{ $row->discount_price }}
                                            </div>
                                      @endif
									<div class="product_name"><div><a href="{{ route('product.details', $row->slug) }}" tabindex="0">{{ substr($row->name, 0, 15) }}..</a></div></div>
								</div>
								<a href="{{ route('add.wishlist', $row->id) }}">
									<div class="product_fav">
	                                    <i class="fas fa-heart"></i>
									</div>
								</a>
								<ul class="product_marks">
									<li class="product_mark product_new">new</li>
								</ul>
							</div>
							@endforeach
						</div>

						<!-- Shop Page Navigation -->

							<!-- Shop Page Navigation -->

						<div class="shop_page_nav d-flex flex-row">
							<ul class="page_nav d-flex flex-row">
								{{ $product->links() }}
							</ul>
						</div>

					</div>

				</div>
			</div>
		</div>
	</div>
	    
    <!-- Recently Viewed -->

    <div class="viewed">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="viewed_title_container">
                        <h3 class="viewed_title">Product For Your</h3>
                        <div class="viewed_nav_container">
                            <div class="viewed_nav viewed_prev"><i class="fas fa-chevron-left"></i></div>
                            <div class="viewed_nav viewed_next"><i class="fas fa-chevron-right"></i></div>
                        </div>
                    </div>

                    <div class="viewed_slider_container">
                        
                        <!-- Recently Viewed Slider -->

                        <div class="owl-carousel owl-theme viewed_slider">
                            @foreach($random as $row)
                            <!-- Recently Viewed Item -->
                            <div class="owl-item">
                                <div class="viewed_item discount d-flex flex-column align-items-center justify-content-center text-center">
                                    <div class="viewed_image">
                                        <img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="{{ $row->name }}">
                                    </div>
                                    <div class="viewed_content text-center">
                                        @if($row->discount_price == Null)
                                            <div class="viewed_price">{{ $setting->currency }}{{ $row->selling_price }}</div>
                                            @else
                                                <div class="viewed_price">
                                                    <del class="text-danger" style="font-size:12px;">{{ $setting->currency }}{{ $row->selling_price }}</del>
                                                    {{ $setting->currency }}{{ $row->discount_price }}
                                                </div>
                                        @endif
                                        <div class="viewed_name"><a href="{{ route('product.details', $row->slug) }}">
                                            {{ substr($row->name, 0, 16) }}..
                                        </a></div>
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
@endsection