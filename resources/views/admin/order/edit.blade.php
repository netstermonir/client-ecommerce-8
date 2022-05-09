<form action="{{ route('order.status.update') }}" method="POST" id="order_status_update_form">
  @csrf
<div class="modal-body">
	<input type="hidden" name="id" value="{{ $data->id }}">
<div class="form-group">
  <label for="c_name">Customer Name</label>
  <input type="text" class="form-control" id="c_name" name="c_name" value="{{ $data->c_name }}" required>
</div>
<div class="form-group">
  <label for="c_address">Address</label>
  <input type="text" class="form-control" id="c_address" name="c_address" value="{{ $data->c_address }}" required>
</div>
<div class="form-group">
  <label for="c_phone">Phone</label>
  <input type="number" class="form-control" id="c_phone" name="c_phone" value="{{ $data->c_phone }}" required>
</div>
<div class="form-group">
  <label for="c_email">Email</label>
  <input type="email" class="form-control" id="c_email" name="c_email" value="{{ $data->c_email }}" required>
</div>
<div class="form-group">
	<select class="form-control submitable" name="status" id="status">
        <option value="0" @if($data->status == 0) selected @endif>Pending</option>
        <option value="1" @if($data->status == 1) selected @endif>Received</option>
        <option value="2" @if($data->status == 2) selected @endif>Shipped</option>
        <option value="3" @if($data->status == 3) selected @endif>Completed</option>
        <option value="4" @if($data->status == 4) selected @endif>Return</option>
        <option value="5" @if($data->status == 5) selected @endif>Cencel</option>
    </select>
</div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" data-dismis="modal"><span class="d-none loader">...Loading...</span> <span class="btn_submit">Update</span></button>
    </div>
</form>
<script type="text/javascript">
	//update cupon data ajax
  $('#order_status_update_form').submit(function(e){
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
        $('#order_status_update_form')[0].reset();
        $('.loading').addClass('d-none');
        $('#categoryeditModal').modal('hide');
        table.ajax.reload();
      }
    });
  });
</script>