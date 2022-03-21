<form action="{{ route('subcategory.update') }}" method="POST">
        @csrf
    <div class="modal-body">
	    <div class="form-group">
                      <label for="category_name">Category Name</label>
                      <select class="form-control" name="category_id" id="category_name" required>
                        @foreach($category as $row)
                        <option value="{{ $row->id }}" @if($row->id == $data->category_id) selected="" @endif>{{ $row->category_name }}</option>
                        @endforeach
                      </select>
                      <small id="cat" class="form-text text-muted">This is Main Category</small>
                    </div>
                    <input type="hidden" name="id" value="{{ $data->id }}">
                    <div class="form-group">
                      <label for="subcat_name">SubCategory Name</label>
                      <input type="text" class="form-control" id="subcat_name" name="subcat_name" aria-describedby="subcat" value="{{ $data->subcat_name }}" required>
                      <small id="subcat" class="form-text text-muted">This is Sub Category</small>
                    </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
            <button type="submit" class="btn btn-primary">Update</button>
    	</div>
</form>