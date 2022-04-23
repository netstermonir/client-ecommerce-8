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
						<div class="cart_title">Shopping Cart</div>
						<div class="cart_items">
							<ul class="cart_list">
								@foreach($cart_data as $row)
								@php
								$product = DB::table('products')->where('id', $row->id)->first();
								$color=explode(',',$product->color);
	 							$sizes=explode(',',$product->size);
								@endphp
								<li class="cart_item clearfix">
									<div class="cart_item_image"><img src="{{ asset('public/files/product/'.$row->options->thumbnail) }}" alt="{{ $row->name }}" title="{{ $row->name }}"></div>
									<div class="cart_item_info d-flex flex-md-row flex-column justify-content-between">
										<div class="cart_item_name cart_info_col">
											<div class="cart_item_text">{{ substr($row->name, 0, 28) }}..</div>
										</div>
										@if($row->options->size)
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_text">
												<select class="custom-select form-control-sm size" data-id="{{ $row->rowId }}" name="size" style="min-width: 120px;">
  												    @foreach($sizes as $size)
  												   		<option value="{{ $size }}" @if($size == $row->options->size) selected @endif>{{ $size }}</option>
  													@endforeach
  												</select>
											</div>
										</div>
										@endif
										@if($row->options->color)
										<div class="cart_item_color cart_info_col">
											<div class="cart_item_text">
												<select class="custom-select form-control-sm color" data-id="{{ $row->rowId }}" name="color" style="min-width: 120px;">
  												   @foreach($color as $colors)
                                    		   			<option value="{{ $colors }}" @if($colors == $row->options->color) selected @endif>{{ $colors }}</option>
                                    			   @endforeach
  												</select>
											</div>
										</div>
										@endif
										<div class="cart_item_quantity cart_info_col">
											<div class="cart_item_text">
												<input type="number" min="1" name="qty" class="form-control-sm qty" data-id="{{ $row->rowId }}" value="{{ $row->qty }}" style="width: 120px; border: 1px solid #ced4da; height: 36px; outline: none;">
											</div>
										</div>
										<div class="cart_item_price cart_info_col">
											<div class="cart_item_text">
												{{ $row->price }} * {{ $row->qty }}
											</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_text">
												{{ $setting->currency }} {{ $row->price * $row->qty}}
											</div>
										</div>
										<div class="cart_item_total cart_info_col">
											<div class="cart_item_text">
												<a href="" data-id="{{ $row->rowId }}" id="removeProduct" title="remove" class="text-danger">X</a>
											</div>
										</div>
									</div>
								</li>
								@endforeach
							</ul>
						</div>
						
						<!-- Order Total -->
						<div class="order_total">
							<div class="order_total_content text-md-right">
								<div class="order_total_title">Order Total:</div>
								<div class="order_total_amount">
									{{ $setting->currency }} {{ Cart::total() }}
								</div>
							</div>
						</div>

						<div class="cart_buttons">
							<button class="btn btn-danger btn-lg">
								<a href="{{ route('cart.empty') }}" class="text-white">Clear Cart</a>
							</button>
							<button type="button" class="button cart_button_checkout">
								<a href="">Checkout</a>
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
	<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="text/javascript">
	// cart product remove
	$('body').on('click','#removeProduct', function(e){
		e.preventDefault();
	    let id=$(this).data('id');
	    let url = '{{ url('cartproduct/remove/') }}/'+id;
	    $.ajax({
	      url: url,
	      type:'get',
	      async:false,
	      success:function(data){
	        toastr.success(data);
	        location.reload()
	        Cart();
	      }
	    });
	});
	//cart qty update
	$('body').on('change','.qty', function(e){
		e.preventDefault();
	    let qty=$(this).val();
	    let rowId = $(this).data('id');
	    let url = '{{ url('cartproduct/updateqty/') }}/'+qty+'/'+rowId;
	    $.ajax({
	      url: url,
	      type:'get',
	      async:false,
	      success:function(data){
	        toastr.success(data);
	        location.reload();
	        Cart();
	      }
	    });
	});
	//cart product size update
	$('body').on('change','.size', function(e){
		e.preventDefault();
	    let size=$(this).val();
	    let rowId = $(this).data('id');
	    let url = '{{ url('cartproduct/updatesize/') }}/'+size+'/'+rowId;
	    $.ajax({
	      url: url,
	      type:'get',
	      async:false,
	      success:function(data){
	        toastr.success(data);
	        location.reload();
	        Cart();
	      }
	    });
	});
	//cart product color update
	$('body').on('change','.color', function(e){
		e.preventDefault();
	    let color=$(this).val();
	    let rowId = $(this).data('id');
	    let url = '{{ url('cartproduct/updatecolor/') }}/'+color+'/'+rowId;
	    $.ajax({
	      url: url,
	      type:'get',
	      async:false,
	      success:function(data){
	        toastr.success(data);
	        location.reload();
	        Cart();
	      }
	    });
	});
</script>
@endsection