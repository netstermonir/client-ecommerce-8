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
			<h2 class="home_title">Track Your Order</h2>
		</div>
	</div>
	<!-- Shop -->

	<div class="shop" style="padding-bottom:30px">
		<div class="container">
			<div class="row">
				<div class="col-lg-6 mx-auto">
                    <div class="card p-4">
                    	<form action="{{ route('track.order') }}" method="post" id="track_id">
                    		@csrf
                    		<div class="form-group">
                    			<label>Track Your Order<span class="text-danger">*</span></label>
                    			<input type="text" class="form-control" name="order_id" placeholder="Enter your Order Id" required>
                    		</div>
                    		<div class="form-group">
                    			<button type="submit" class="btn btn-primary">Track</button>
                    		</div>
                    	</form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <hr>
@endsection
