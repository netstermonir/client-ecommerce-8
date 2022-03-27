<form action="{{ route('cupon.update') }}" method="POST" id="update_form">
      @csrf
    <div class="modal-body">
    <input type="hidden" name="id" value="{{ $data->id }}">
    <div class="form-group">
      <label for="coupon_code">Cupon Code</label>
      <input type="text" class="form-control" id="coupon_code" name="coupon_code" value="{{ $data->coupon_code }}" required>
    </div>
    <div class="form-group">
      <label for="type">Cupon Type</label>
      <select class="form-control" name="type" id="type" required>
      	<option value="1" @if($data->type == 1) selected @endif>Fixed</option>
      	<option value="2" @if($data->type == 2) selected @endif>Percentage</option>
      </select>
    </div>
    <div class="form-group">
      <label for="status">Cupon Status</label>
      <select class="form-control" name="status" id="status" required>
      	<option value="Active" @if($data->status == 'Active') selected @endif>Active</option>
      	<option value="Inactive" @if($data->status == 'Inactive') selected @endif>Inactive</option>
      </select>
    </div>
    <div class="form-group">
      <label for="amount">Amount</label>
      <input type="number" class="form-control" id="amount" name="coupon_amount" value="{{ $data->coupon_amount }}" required>
    </div>
    <div class="form-group">
      <label for="date">Valid Date</label>
      <input type="date" class="form-control" id="date" name="valid_date" value="{{ $data->valid_date }}" required>
    </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary" data-dismis="modal"><span class="d-none loader">...Loading...</span> <span class="btn_submit">Update</span></button>
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