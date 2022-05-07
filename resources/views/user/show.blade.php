@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
        	<div class="card  p-2">
        	  <div class="row">	
        		<h3 class="ml-4">Your Ticket Details</h3>
        		<div class="col-md-9">
        			<strong>Subject: {{  $tricket->subject }}</strong><br>
        			<strong>Service: {{  $tricket->service }}</strong><br>
        			<strong>Priority: {{  $tricket->priority }}</strong><br>
        			<strong>Message: {{  $tricket->message }}</strong>
        		</div>
        		<div class="col-md-3">
        		 <a href="{{ asset($tricket->image) }}" target="_blank"><img src="{{ asset($tricket->image) }}" style="height:80px; width:120px; border:1px solid grey;" alt="{{ $tricket->subject }}" title="{{ $tricket->subject }}"></a>
        		</div>
        		</div>
        	</div>

        	{{-- All reply message show here --}}
        	{{-- @php 
        		$replies=DB::table('replies')->where('ticket_id',$ticket->id)->orderBy('id','DESC')->get();
        	@endphp --}}

        	{{-- <div class="card p-2 mt-2">
        		<strong>All Reply Message.</strong><br>
        		<div class="card-body" style="height: 450px; overflow-y: scroll;">
        		@isset($replies)	
        		   @foreach($replies as $row)
        			<div class="card mt-1 @if($row->user_id==0) ml-4 @endif">
					  <div class="card-header @if($row->user_id==0) bg-info @else bg-danger @endif ">
					   <i class="fa fa-user"></i> @if($row->user_id==0) Admin @else {{ Auth::user()->name }}@endif
					  </div>
					  <div class="card-body">
					    <blockquote class="blockquote mb-0">
					      <p>{{ $row->message }}</p>
					      <footer class="blockquote-footer">{{ date('d F Y'),strtotime($row->reply_date) }}</footer>
					    </blockquote>
					  </div>
					</div>
				  @endforeach	
				@endisset	
        		</div>
        	</div> --}}


            <div class="card mt-2">
                <div class="card-body">
                   <strong>Reply Tricket.</strong><br>
                   <div>
                   	  <form {{-- action="{{ route('reply.ticket') }} --}} method="post" enctype="multipart/form-data">
                   	  	@csrf
                   	    <div class="form-group">
                   	      <label for="exampleInputPassword1">Message<span class="text-danger">*</span></label>
                   	      <textarea class="form-control" name="message" required=""></textarea>
                   	        <input type="hidden" name="ticket_id" value="{{ $tricket->id }}">
                   	    </div>
                   	    <div>
                   	    	<label for="exampleInputPassword1">Attached File<span class="text-danger">*</span></label>
                   	    	<input type="file" class="form-control" name="image" >
                   	    </div><br>
                   	    <button type="submit" class="btn btn-primary">Reply Tricket</button>
                   	  </form>
                   </div>
                </div>
            </div>
        </div>
    </div>
</div><hr>
@endsection
