<form action="{{ route('blog_category.update') }}" method="POST" id="blog_category_update_form">
  @csrf
<div class="modal-body">
	<input type="hidden" name="id" value="{{ $data->id }}">
	<div class="form-group">
	  <label for="blog_categoy_name">Category Name</label>
	  <input type="text" class="form-control" id="blog_categoy_name" name="blog_categoy_name" value="{{ $data->blog_categoy_name }}" required>
	</div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" data-dismis="modal"><span class="d-none loader">...Loading...</span> <span class="btn_submit">Update</span></button>
    </div>
</form>
<script type="text/javascript">
	//update blog cat data ajax
  $('#blog_category_update_form').submit(function(e){
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
        $('#blog_category_update_form')[0].reset();
        $('.loading').addClass('d-none');
        $('#categoryeditModal').modal('hide');
        table.ajax.reload();
      }
    });
  });
</script>