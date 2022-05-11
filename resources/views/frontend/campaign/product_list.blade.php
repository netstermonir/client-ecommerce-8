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
			<h2 class="home_title">{{ $campaign->name }}</h2>
		</div>
	</div>
	<!-- Shop -->

	<div class="shop" style="padding-bottom:30px;">
		<div class="container">
			<div class="row">

				<div class="col-lg-12">
					
					<!-- Shop Content -->

					<div class="shop_content">
						<div class="shop_bar clearfix">
							<div class="shop_product_count"><span>{{ count($product) }}</span> products found</div>
						</div>

						<div class="product_grid" style="margin-top:30px">
							<div class="product_grid_border"></div>
							@foreach($product as $row)
							<!-- Product Item -->
							<div class="product_item is_new">
								<div class="product_border"></div>
								<div class="product_image d-flex flex-column align-items-center justify-content-center"><img src="{{ asset('public/files/product/'.$row->thumbnail) }}" width="70%" alt="{{ $row->name }}"></div>
								<div class="product_content">
									<div class="product_price">{{ $setting->currency }}{{ $row->price }}</div>
									<div class="product_name"><div><a href="{{ route('campaign.products.details', $row->slug) }}" tabindex="0">{{ substr($row->name, 0, 15) }}..</a></div></div>
								</div>
								<a href="{{ route('add.wishlist', $row->product_id) }}">
									<div class="product_fav">
	                                    <i class="fas fa-heart"></i>
									</div>
								</a>
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
@endsection