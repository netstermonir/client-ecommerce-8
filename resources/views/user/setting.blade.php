@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Dashboard') }}
                    <a href="{{ route('write.review') }}" style="float:right;"><i class="fas fa-pencil-alt"></i> Write a review</a>
                </div>

                <div class="card-body">
                   <h4>Write your Default Shipping.</h4><br>
                   <div>
                   	  <form action="" method="post">
                   	  	@csrf
                   	    <div class="form-group">
                            <label for="shipping_name">Shipping Name</label>
                            <input type="text" class="form-control" name="shipping_name" id="shipping_name">
                   	    </div>
                        <div class="form-group">
                            <label for="shipping_address">Shipping Address</label>
                            <input type="text" class="form-control" name="shipping_address" id="shipping_address">
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-4">
                                <label for="shipping_country">Shipping Country</label>
                                <input type="text" class="form-control" name="shipping_country" id="shipping_country">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="shipping_city">Shipping City</label>
                                <input type="text" class="form-control" name="shipping_city" id="shipping_city">
                            </div>
                            <div class="form-group col-lg-4">
                                <label for="shipping_postcode">Shipping PostCode</label>
                                <input type="text" class="form-control" name="shipping_postcode" id="shipping_postcode">
                            </div>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6">
                                <label for="shipping_phone">Shipping Phone</label>
                                <input type="text" class="form-control" name="shipping_phone" id="shipping_phone">
                            </div>
                            <div class="form-group col-lg-6">
                                <label for="shipping_email">Shipping Email</label>
                                <input type="text" class="form-control" name="shipping_email" id="shipping_email">
                            </div>
                        </div>
                   	    <button type="submit" class="btn btn-primary" style="cursor: pointer">Set Default Shipping</button>
                   	  </form>
                   </div>
                </div><br><hr>
                <div class="card-body">
                    <h4>Change Your Password</h4><br>
                    <div>
                          <form action="{{ route('customar.passwordChange') }}" method="post">
                              @csrf
                            <div class="form-group">
                             <label for="old">Old Password</label>
                             <input type="password" class="form-control" name="old_password" id="old">
                            </div>
                            <div class="form-group">
                                <label for="current_password">New Password</label>
                                <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="current_password" required>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="confirm_password" required>
                            </div>
                            <button type="submit" class="btn btn-primary" style="cursor: pointer">Change Password</button>
                          </form>
                    </div>
                 </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
