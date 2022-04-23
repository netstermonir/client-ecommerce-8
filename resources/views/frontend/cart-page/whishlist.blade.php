@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_responsive.css">
@include('layouts.front-partial.collapse')

	<!-- Cart -->

	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-12">
					<div class="cart_container">
						<div class="cart_title">Whishlist Item</div>
						<div class="cart_items">
							<ul class="cart_list">
								@foreach($wishlist as $row)
								<li class="cart_item clearfix">
									<div class="cart_item_image"><img src="{{ asset('public/files/product/'.$row->thumbnail) }}" alt="{{ $row->name }}" title="{{ $row->name }}"></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_text">{{ substr($row->name, 0, 28) }}..</div>
										</div>
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_text">{{ $row->date }}</div>
										</div>
										<div class="cart_item_name cart_info_col">
											<button type="button" style="margin-top: 30px; outline: none;" class="button cart_button_checkout">
												<a href="{{ route('product.details', $row->slug) }}">Add To Cart</a>
											</button>
										</div>
										<div class="cart_item_name cart_info_col">
											<div style="margin-top: 36px; outline: none;">
												<a href="{{ route('whishlistproduct.delete', $row->id) }}" class="cart_item_text">X</a>
											</div>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>

						<div class="cart_buttons">
							<button class="btn btn-danger btn-lg">
								<a href="{{ route('wishlist.empty') }}" class="text-white">Clear Wishlist</a>
							</button>
							<button type="button" class="button cart_button_checkout">
								<a href="{{ url('/') }}">Back Home</a>
							</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- Newsletter -->

	<div class="newsletter">
		<div class="container">
			<div class="row">
				<div class="col">
					<div class="newsletter_container d-flex flex-lg-row flex-column align-items-lg-center align-items-center justify-content-lg-start justify-content-center">
						<div class="newsletter_title_container">
							<div class="newsletter_icon"><img src="images/send.png" alt=""></div>
							<div class="newsletter_title">Sign up for Newsletter</div>
							<div class="newsletter_text"><p>...and receive %20 coupon for first shopping.</p></div>
						</div>
						<div class="newsletter_content clearfix">
							<form action="#" class="newsletter_form">
								<input type="email" class="newsletter_input" required="required" placeholder="Enter your email address">
								<button class="newsletter_button">Subscribe</button>
							</form>
							<div class="newsletter_unsubscribe_link"><a href="#">unsubscribe</a></div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
@endsection