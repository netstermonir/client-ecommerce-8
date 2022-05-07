@extends('layouts.admin')
@section('admin_content')



  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>New Product</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Ticket Reply</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <div class="content">
    	<div class="container-fluid">
    		<div class="card  p-2">
        	  <div class="row">	
        		<div class="col-md-9">
        			<strong>User: {{  $tricket->name }}</strong><br>
        			<strong>Subject: {{  $tricket->subject }}</strong><br>
        			<strong>Service: {{  $tricket->service }}</strong><br>
        			<strong>Priority: {{  $tricket->priority }}</strong><br>
        			<strong>Message: {{  $tricket->message }}</strong>
        		</div>
        		<div class="col-md-3">
        		 <a href="{{ asset($tricket->image) }}" target="_blank"><img src="{{ asset($tricket->image) }}" style="height:80px; width:120px;"></a>
        		</div>
        		</div>
        	</div>
    	</div>
    </div>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
       <form action="{{ route('admin.store.reply') }}" method="post" enctype="multipart/form-data" id="reply_tricket">
        @csrf
       	<div class="row">
          <!-- left column -->
          <div class="col-md-5">
            <!-- general form elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Reply Ticket Message</h3>
              </div>
              <!-- /.card-header -->
                <div class="card-body">
                  <div class="row">
                    <div class="form-group col-lg-12">
                      <label for="exampleInputEmail1">Message<span class="text-danger">*</span> </label>
                      <textarea type="text" class="form-control" name="message" required=""> </textarea>
                      <input type="hidden" name="tricket_id" value="{{ $tricket->id }}">
                    </div>
                    <div class="form-group col-lg-12">
                      <label for="exampleInputPassword1">Attached File  </label>
                      <input type="file" class="form-control"  name="image">
                    </div>
                  </div>
                  <div>
                  	<button type="submit" class="btn btn-info">Reply Message</button>
                  </div>
                </div>
                <!-- /.card-body -->
            </div>
            <!-- /.card -->
            <a href="{{ route('admin.close.tricket', $tricket->id) }}" class="btn btn-danger" style="float:right;"> Close Ticket </a>
           </div>
        </form> 

            <!-- /.card -->
          <!-- right column -->
          <div class="col-md-7">
          	@php 
          		$replies=DB::table('replied')->where('tricket_id',$tricket->id)->orderBy('id','DESC')->get();
          	@endphp

            <!-- Form Element sizes -->
            <div class="card card-primary">
            <div class="card-header">All Replies</div>
              	<div class="card-body" style="height: 400px; overflow-y: scroll;">

        		@isset($replies)	
        		   @foreach($replies as $row)
        			<div class="card mt-1 @if($row->user_id==0) ml-4 @endif">
					  <div class="card-header @if($row->user_id==0) bg-info @else bg-danger @endif ">
					   <i class="fa fa-user"></i> @if($row->user_id==0) Admin @else {{ $tricket->name }} @endif
					  </div>
					  <div class="row">
					  	<div class="col-md-9">
					  		<div class="card-body">
						    	<blockquote class="blockquote mb-0">
							      <p>{{ $row->replied_message }}</p>
							      <footer class="blockquote-footer">{{ date('d F Y'),strtotime($row->replied_date) }}</footer>
							    </blockquote>
					  		</div>
					  	</div>
					  	<div class="col-md-3 pt-2">
					  		@if($row->replied_image)
		        		 	<a href="{{ asset($row->replied_image) }}" target="_blank">
		        		 		<img src="{{ asset($row->replied_image) }}" style="height:80px; width:120px; border:1px solid grey;">
		        		 	</a>
		        		 	@else
		        		 		<span class="pr-1" style="font-size:10px">Image Not Submit</span>
		        		 	@endif
		        		</div>
					  </div>
					</div>
				  @endforeach	
				@endisset	

        	 </div>
           </div>
         </div>
      
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
 <script type="text/javascript">
 	$(function(){
        $('#reply_tricket').on('submit', function(e){
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
	                    window.location.reload();
	                }
                  $('#reply_tricket')[0].reset();
                }
            });
        });
    });
 </script>


@endsection