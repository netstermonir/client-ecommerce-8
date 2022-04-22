<form action="{{ route('brand.update') }}" method="POST" id="add_form" enctype="multipart/form-data">
  @csrf
<div class="modal-body">
<div class="form-group">
  <label for="brand_name">Brand Name</label>
  <input type="text" class="form-control" id="brand_name" name="brand_name" value="{{ $data->brand_name }}" aria-describedby="brand" required>
  <small id="brand" class="form-text text-muted">This is Brand Name</small>
</div>
<input type="hidden" name="id" value="{{ $data->id }}">
<div class="form-group">
    <label for="front_page">Home Brand</label>
    <select class="form-control" name="front_page">
      <option value="1" @if($data->front_page == 1) selected @endif>Yes</option>
      <option value="0" @if($data->front_page == 0) selected @endif>No</option>
    </select>
    <small class="form-text text-muted">If yes it will be show on your home page</small>
</div>
<div class="form-group">
  <label for="brand_logo">Brand Logo</label>
  <input type="file" class="form-control dropify" data-height="140" name="brand_logo" aria-describedby="brand_logo" onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])">
  <input type="hidden" name="old_logo" value="{{ $data->brand_logo }}" >
  <small id="brand_logo" class="form-text text-muted">This is Brand Logo</small>
</div>
<div class="form-group">
  	<div style="width:'100%'; height: '300px'; overflow: hidden; text-align: center; ">
  		<img id="image_id" src="{{ $data->brand_logo }}" width="100px" height="100px" />
  	</div>
  </div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary"><span class="d-none">...Loading...</span> Save</button>
    </div>
</form>