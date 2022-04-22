<form action="{{ route('category.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
      <div class="modal-body">
      <div class="form-group">
        <label for="e_category_name">Edit Category Name</label>
        <input type="text" class="form-control" id="e_category_name" name="category_name" aria-describedby="cat" value="{{ $data->category_name }}" required>
        <input type="hidden" class="form-control" id="e_category_name_id" name="id" value="{{ $data->id }}">
        <small id="cat" class="form-text text-muted">This is Manin Category</small>
      </div>
      <div class="form-group">
          <label for="category_name">Show on Homepage</label>
         <select class="form-control" name="status">
           <option value="1" @if($data->status == "1") selected @endif>Yes</option>
           <option value="0" @if($data->status == "0") selected @endif>No</option>
         </select>
          <small id="emailHelp" class="form-text text-muted">If yes it will be show on your home page</small>

      </div> 
      <div class="form-group">
        <label for="icon">Category Icon</label>
        <input type="file" class="form-control dropify" data-height="140" name="icon" aria-describedby="icon" onchange="document.getElementById('image_id').src = window.URL.createObjectURL(this.files[0])">
        <input type="hidden" name="old_logo" value="{{ $data->icon }}" >
        <small id="icon" class="form-text text-muted">This is Category Icon</small>
      </div>
<div class="form-group">
    <div style="width:'100%'; height: '300px'; overflow: hidden; text-align: center; ">
      <img id="image_id" src="{{ $data->icon }}" width="100px" height="100px" />
    </div>
  </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
</form>