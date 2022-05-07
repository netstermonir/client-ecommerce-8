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
                   <h4>Submit your valuable Tricket.We will reply within 24 hours.</h4><br>
                   <div>
                   	  <form action="{{ route('tricket.store') }}" method="post" id="submit_tricket" enctype="multipart/form-data">
                   	  	@csrf
                   	    <div class="form-group">
                   	      <label for="exampleInputEmail1">Subject<span class="text-danger">*</span></label>
                   	      <input type="text" class="form-control @error('subject') is-invalid @enderror" name="subject" required>
                   	      	@error('subject')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                   	    </div>
                   	    <div class="row">
                   	    	<div class="form-group col-md-6">
	                   	      <label for="exampleInputEmail1">Service<span class="text-danger">*</span></label>
	                   	      <select class="form-control" name="service" style="min-width: 100%; margin-left:0">
	                   	      	<option value="Technical">Technical</option>
	                   	      	<option value="Payment">Payment</option>
	                   	      	<option value="Order">Order</option>
	                   	      	<option value="Return">Return</option>
	                   	      	<option value="Affiliate">Affiliate</option>
	                   	      </select>
                   	    	</div>
                   	    	<div class="form-group col-md-6">
	                   	      <label for="exampleInputEmail1">Priority<span class="text-danger">*</span></label>
	                   	      <select class="form-control" name="priority" style="min-width: 100%; margin-left:0">
	                   	      	<option value="Low">Low</option>
	                   	      	<option value="Medium">Medium</option>
	                   	      	<option value="High">High</option>
	                   	      </select>
                   	    	</div>
                   	    </div>
                   	    <div class="form-group">
                   	      <label for="exampleInputPassword1">Message<span class="text-danger">*</span></label>
                   	      <textarea class="form-control @error('message') is-invalid @enderror" name="message" required=""></textarea>
                   	      	@error('message')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                   	    </div>
                   	    <div>
                   	    	<label for="exampleInputPassword1">Attached File</label>
                   	    	<input type="file" name="image" class="form-control">
                   	    </div><br>
                   	    <button type="submit" class="btn btn-primary" style="cursor: pointer">Submit Tricket</button>
                   	  </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script type="text/javascript">
 	$(function(){
        $('#submit_tricket').on('submit', function(e){
            e.preventDefault();
            var form_data = this;
            $.ajax({
                url:$(form_data).attr('action'),
                method:$(form_data).attr('method'),
                data:new FormData(form_data),
                processData:false,
                dataType:'json',
                contentType:false,
                success:function(data){
					if(data.success){
	                    toastr.success(data.success);
	                }
                  $('#submit_tricket')[0].reset();
                }
            });
        });
    });
 </script>
@endsection
