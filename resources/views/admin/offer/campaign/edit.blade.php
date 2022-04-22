<form action="{{ route('campaign.update') }}" method="POST" id="update_form" enctype="multipart/form-data">
  @csrf
<div class="modal-body">
	<input type="hidden" name="id" value="{{ $data->id }}">
	<div class="form-group">
		<label for="campaign_name">Campaign Name <span class="text-danger">*</span></label>
		<input type="text" class="form-control" id="campaign_name" name="name" aria-describedby="campaign" value="{{ $data->name }}">
	</div>
	<div class="row">
		<div class="col-lg-6">
			<label for="start_date">Start Date <span class="text-danger">*</span></label>
			<input type="date" class="form-control" id="start_date" name="start_date" value="{{ $data->start_date }}">
		</div>
		<div class="col-lg-6">
			<label for="end_date">End Date <span class="text-danger">*</span></label>
			<input type="date" class="form-control" id="end_date" name="end_date" value="{{ $data->end_date }}">
		</div>
	</div>
	<div class="row">
		<div class="col-lg-6">
			<label for="start_date">Status <span class="text-danger">*</span></label>
			<select class="form-control" name="status">
			  <option value="1" @if($data->status == "1") selected @endif>Active</option>
			  <option value="0" @if($data->status == "0") selected @endif>Inactive</option>
			</select>
		</div>
		<div class="col-lg-6">
			<label for="discount">Discount(%) <span class="text-danger">*</span></label>
			<input type="number" class="form-control" id="discount" name="discount" aria-describedby="discount" value="{{ $data->discount }}">
		</div>
	</div>
	<div class="form-group">
	  <label for="image">Campaign Logo</label>
	  <input type="file" class="form-control dropify" data-height="140" name="image" aria-describedby="image" onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])">
	  <input type="hidden" name="old_logo" value="{{ $data->image }}" >
	</div>
	<div class="form-group">
	  	<div style="width:'100%'; height: '300px'; overflow: hidden; text-align: center; ">
	  		<img id="image_id" src="{{ $data->image }}" width="100px" height="100px" />
	  	</div>
	  </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary"><span class="d-none">...Loading...</span> Save</button>
    </div>
</form>
 <script type="text/javascript">
	//update cupon data ajax
  $('#update_form').submit(function(e){
    e.preventDefault();
    $('.loading').removeClass('d-none');
    var url = $(this).attr('action');
    var request =$(this).serialize();
    $.ajax({
      url:url,
      type:'post',
      async:false,
      data:request,
      success:function(data){
        toastr.success(data);
        $('#update_form')[0].reset();
        $('.loading').addClass('d-none');
        $('#categoryeditModal').modal('hide');
        table.ajax.reload();
      }
    });
  });
  </script>