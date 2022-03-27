<form action="{{ route('warehouse.update') }}" method="POST" id="add_form">
 @csrf
<div class="modal-body">
<input type="hidden" name="id" value="{{ $data->id }}">
<div class="form-group">
  <label for="warehouse_name">Warehouse Name</label>
  <input type="text" class="form-control" id="warehouse_name" name="warehouse_name" value="{{ $data->warehouse_name }}" required>
</div>
<div class="form-group">
  <label for="warehouse_address">Warehouse Addewss</label>
  <input type="text" class="form-control" id="warehouse_address" name="warehouse_address" value="{{ $data->warehouse_address }}" required>
</div>
<div class="form-group">
  <label for="warehouse_phone">Warehouse Phone</label>
  <input type="text" class="form-control" id="warehouse_phone" name="warehouse_phone" value="{{ $data->warehouse_phone }}" required>
</div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" data-dismis="modal"><span class="d-none loader">...Loading...</span> <span class="btn_submit">update</span></button>
    </div>
</form>