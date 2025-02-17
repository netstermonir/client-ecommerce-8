@extends('layouts.app')
@section('content')
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_responsive.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/product_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_styles.css">
<link rel="stylesheet" type="text/css" href="{{ asset('public/frontend') }}/styles/cart_responsive.css">
@include('layouts.front-partial.collapse')


	<div class="cart_section">
		<div class="container">
			<div class="row">
				<div class="col-lg-8">
					<div class="cart_container card p-1">
						<div class="cart_title text-center">Billing Address</div>

						  <form action="{{ route('order.place') }}" method="post" id="order_place">
						  	@csrf
							<div class="row p-4">
							  <div class="form-group col-lg-6">
								<label>Customer Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="{{ Auth::user()->name }}" name="c_name" required="" >
							  </div>
							  <div class="form-group col-lg-6">
								<label>Customer Phone <span class="text-danger">*</span></label>
								<input type="text" class="form-control" value="{{ Auth::user()->phone }}" name="c_phone" required="" >
							  </div>
							  <div class="form-group col-lg-6">
								<label> Country <span class="text-danger">*</span></label>
								<input type="text" class="form-control" name="c_country" required="" >
							  </div>
							  <div class="form-group col-lg-6">
								<label>Shipping Address <span class="text-danger">*</span> </label>
								<input type="text" class="form-control" name="c_address" required="" >
							  </div>

							  <div class="form-group col-lg-6">
								<label>Email Address</label>
								<input type="email" class="form-control" name="c_email" value="{{ Auth::user()->email }}" >
							  </div>
							  <div class="form-group col-lg-6">
								<label>Zip Code</label>
								<input type="text" class="form-control" name="c_zipcode" required="">
							  </div>
							  <div class="form-group col-lg-6">
								<label>City Name</label>
								<input type="text" class="form-control" name="c_city" required="">
							  </div>
							  <div class="form-group col-lg-6">
								<label>Extra Phone</label>
								<input type="text" class="form-control" name="c_extra_phone" required="" >
							  </div>
								<br>
							  	   <div class="form-group col-lg-4">
							  	 	<label>Paypal</label>
							  	 	<input type="radio"  name="payment_type" value="Paypal" disabled>
							  	   </div>
							  	   <div class="form-group col-lg-4">
							  	 	<label>Bkash/Rocket/Nagad </label>
							  	 	<input type="radio"  name="payment_type" checked="" value="Aamarpay" >
							  	   </div>
							  	   <div class="form-group col-lg-4">
							  	 	<label>Hand Cash</label>
							  	 	<input type="radio"  name="payment_type" value="Hand Cash" >
							  	   </div>

                                    <div class="form-group">
                                        <button type="submit" class="btn btn-info">Order Place</button>
                                    </div>
                                    <span class="visually-hidden d-none progress">Progressing.....</span>
							</div>
						  </form>


						<!-- Order Total -->

					</div>
				</div>
				<div class="col-lg-4" >
					<div class="card">
						<div class="pl-4 pt-2">
							<p style="color: black;">Subtotal: <span style="float: right; padding-right: 5px;">{{ Cart::subtotal() }} {{ $setting->currency }}</span> </p>
							{{-- coupon apply --}}
							@if(Session::has('coupon'))
							<p style="color: black;">coupon:({{ Session::get('coupon')['name'] }}) <a href="{{ route('coupon.remove') }}" class="text-danger">X</a> <span style="float: right; padding-right: 5px;">{{ Session::get('coupon')['discount'] }} {{ $setting->currency }}</span>  </p>
							@else
							@endif

							<p style="color: black;">Tax: <span style="float: right; padding-right: 5px;">0.00 % {{ $setting->currency }}</span></p>
							<p style="color: black;">shipping: <span style="float: right; padding-right: 5px;">0.00 {{ $setting->currency }}</span></p>

							@if(Session::has('coupon'))
							<p style="color: black;"><b> Total: <span style="float: right; padding-right: 5px;"> {{ Session::get('coupon')['after_discount'] }} {{ $setting->currency }} </span></b></p>
							@else
								<p style="color: black;"><b> Total: <span style="float: right; padding-right: 5px;"> {{ Cart::total() }} {{ $setting->currency }} </span></b></p>
							@endif
						</div><hr>

						@if(!Session::has('coupon'))
						<form action="{{ route('apply.coupon') }}" method="post" id="apply_coupon">
							@csrf
							<div class="p-4">
							  <div class="form-group">
								<label>Coupon Apply</label>
								<input type="text" class="form-control" name="coupon" required="" placeholder="Coupon Code" autocomplete="off" id="coupon">
							  </div>
							  <div class="form-group">
							  	<button type="submit" class="btn btn-info">Apply Coupon</button>
							  </div>
							</div>
						</form>
						@endif
					</div>

				</div>
			</div>
		</div>
	</div>


    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
	<script type="text/javascript">

        $('#apply_coupon').submit(function(e){
            e.preventDefault();
            var url = $(this).attr('action');
            var request = $(this).serialize();
            $.ajax({
            url:url,
            type:'post',
            async:false,
            data:request,
            success:function(data){
                if(data.success){
                    toastr.success(data.success);
                    location.reload();
                }
                if(data.error){
                    toastr.error(data.error);
                }
                if (data.errormessage) {
                	toastr.error(data.errormessage);
                }
                $('#apply_coupon')[0].reset();
            }
            });
        });
        // $('#order_place').submit(function(e){
        //     e.preventDefault();
        //     var url = $(this).attr('action');
        //     var request = $(this).serialize();
        //     $.ajax({
        //     url:url,
        //     type:'post',
        //     async:false,
        //     data:request,
        //     success:function(data){
        //         if(data.success){
        //             toastr.success(data.success);
        //             location.reload();
        //         }
        //         $('#order_place')[0].reset();
        //     }
        //     });
        // });
	</script>

@endsection
