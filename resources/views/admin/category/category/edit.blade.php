<form action="{{ route('category.update') }}" method="POST">
        @csrf
      <div class="modal-body">
      <div class="form-group">
        <label for="e_category_name">Edit Category Name</label>
        <input type="text" class="form-control" id="e_category_name" name="category_name" aria-describedby="cat" value="{{ $data->category_name }}" required>
        <input type="hidden" class="form-control" id="e_category_name_id" name="id" value="{{ $data->id }}">
        <small id="cat" class="form-text text-muted">This is Manin Category</small>
      </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
          </div>
</form>