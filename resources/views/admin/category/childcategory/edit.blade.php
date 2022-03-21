<form action="{{ route('childcategory.update') }}" method="POST" id="add_form">
  @csrf
<div class="modal-body">
  <div class="form-group">
  <label for="subcategory_id">Category/SubCategory Name</label>
  <select class="form-control" name="subcategory_id" id="subcategory_id" required>
    @foreach($category as $row)
    @php
    	$subcat = DB::table('subcategories')->where('category_id', $row->id)->get();
    @endphp
    	<option value="{{ $row->id }}" disabled="" style="color: white;">{{ $row->category_name }}</option>
    @foreach($subcat as $row)
    	<option value="{{ $row->id }}" @if($row->id == $data->subcategory_id) selected="" @endif> -- {{ $row->subcat_name }}</option>
    @endforeach
    @endforeach
  </select>
  <small id="cat" class="form-text text-muted">This is Main/Sub Category</small>
</div>
<input type="hidden" name="id" value="{{ $data->id }}">
<div class="form-group">
  <label for="childcategory_name">ChildCategory Name</label>
  <input type="text" class="form-control" id="childcategory_name" name="childcategory_name" aria-describedby="subcat" value="{{ $data->childcategory_name }}" required>
  <small id="subcat" class="form-text text-muted">This is Child Category</small>
</div>
    <div class="modal-footer">
      <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary"><span class="d-none">...Loading...</span> Save</button>
    </div>
</form>