<form action="{{ route('pickuppoint.update') }}" method="POST" id="pickup_update_form">
  @csrf
<div class="modal-body">
	<input type="hidden" name="id" value="{{ $data->id }}">
<div class="form-group">
  <label for="pickup_point_name">Pickup Point Name</label>
  <input type="text" class="form-control" id="pickup_point_name" name="pickup_point_name" value="{{ $data->pickup_point_name }}" required>
</div>
<div class="form-group">
  <label for="pickup_point_address">Pickup Point Address</label>
  <input type="text" class="form-control" id="pickup_point_address" name="pickup_point_address" value="{{ $data->pickup_point_address }}" required>
</div>
<div class="form-group">
  <label for="pickup_point_phone">Pickup Point Phone</label>
  <input type="number" class="form-control" id="pickup_point_phone" name="pickup_point_phone" value="{{ $data->pickup_point_phone }}" required>
</div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" data-dismis="modal"><span class="d-none loader">...Loading...</span> <span class="btn_submit">Update</span></button>
    </div>
</form>
<script type="text/javascript">
	//update cupon data ajax
  $('#pickup_update_form').submit(function(e){
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
        $('#pickup_update_form')[0].reset();
        $('.loading').addClass('d-none');
        $('#categoryeditModal').modal('hide');
        table.ajax.reload();
      }
    });
  });
</script>