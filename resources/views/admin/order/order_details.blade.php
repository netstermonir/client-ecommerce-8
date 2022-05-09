<form action="{{ route('order.details.status.update') }}" method="POST" id="status_update_form">
  @csrf
<div class="modal-body">
	<input type="hidden" name="id" value="{{ $order->id }}">
	<input type="hidden" name="c_name" value="{{ $order->c_name }}">
	<input type="hidden" name="c_address" value="{{ $order->c_address }}">
	<input type="hidden" name="c_phone" value="{{ $order->c_phone }}">
	<input type="hidden" name="date" value="{{ $order->date }}">
	<input type="hidden" name="c_email" value="{{ $order->c_email }}">
	<input type="hidden" name="c_country" value="{{ $order->c_country }}">
	<input type="hidden" name="c_zipcode" value="{{ $order->c_zipcode }}">
	<input type="hidden" name="c_city" value="{{ $order->c_city }}">
	<input type="hidden" name="order_id" value="{{ $order->order_id }}">
	<input type="hidden" name="status" value="{{ $order->status }}">
	<input type="hidden" name="payment_type" value="{{ $order->payment_type }}">
	<input type="hidden" name="total" value="{{ $order->total }}">
<div class="card">
	<div class="card-body">
		<div class="row">
    		<div class="col-md-4">
    			<td><b>Name:</b> {{ $order->c_name }}</td><br>
            	<td><b>Address:</b> {{ $order->c_address }}</td><br>
            	<td><b>Phone:</b> {{ $order->c_phone }}</td><br>
            	<td><b>Date:</b> {{ $order->date }}</td>
    		</div>
    		<div class="col-md-4">
    			<td><b>Email:</b> {{ $order->c_email }}</td><br>
    			<td><b>Country:</b> {{ $order->c_country }}</td><br>
            	<td><b>ZipCode:</b> {{ $order->c_zipcode }}</td><br>
            	<td><b>City:</b> {{ $order->c_city }}</td>
    		</div>
    		<div class="col-md-4">
    			<td><b>OrderID:</b> {{ $order->order_id }}</td><br>
            	<td><b>Status:</b> 
                	  @if($order->status==0)
                         <span class="badge badge-danger">Order Pending</span>
                      @elseif($order->status==1)
                         <span class="badge badge-info">Order Recieved</span>
                      @elseif($order->status==2)
                         <span class="badge badge-warning">Order Shipped</span>
                      @elseif($order->status==3)
                         <span class="badge badge-success">Order Completed</span>
                      @elseif($order->status==4)
                         <span class="badge badge-warning">Order Return</span>
                      @elseif($order->status==5)
                         <span class="badge badge-danger">Order Cancel</span>
                      @endif
            	</td><br>
            	<td><b>Payment:</b> {{ $order->payment_type }}</td><br>
            	<td><b>Total:</b> {{ $order->total }}{{ $setting->currency }}</td>
    		</div>
		</div>
	</div>
	<br>
	<div class="card mt-2">
		<div class="card-body">
			<div>
               <table class="table">
                 <thead>
                   <tr>
                     <th scope="col">SL</th>
                     <th scope="col">Product</th>
                     <th scope="col">Color</th>
                     <th scope="col">Size</th>
                     <th scope="col">Qty</th>
                     <th scope="col">Price</th>
                     <th scope="col">SubTotal</th>
                   </tr>
                 </thead>
                 <tbody>
                  @foreach($order_details as $key => $row)
                   <tr>
                     <th scope="row">{{ ++$key }}</th>
                     <td>{{ $row->product_name }}</td>
                     <td>{{ $row->color }}</td>
                     <td>{{ $row->size }}</td>
                     <td>{{ $row->quantity }}</td>
                     <td>{{ $row->product_price }}{{ $setting->currency }}</td>
                     <td>{{ $row->subtotal_price }}{{ $setting->currency }}</td>
                   </tr>
                  @endforeach
                 </tbody>
               </table>
           </div>
		</div>
	</div>
</div>
<div class="form-group">
	<select class="form-control submitable" name="status" id="status">
        <option value="0" @if($order->status == 0) selected @endif>Pending</option>
        <option value="1" @if($order->status == 1) selected @endif>Received</option>
        <option value="2" @if($order->status == 2) selected @endif>Shipped</option>
        <option value="3" @if($order->status == 3) selected @endif>Completed</option>
        <option value="4" @if($order->status == 4) selected @endif>Return</option>
        <option value="5" @if($order->status == 5) selected @endif>Cencel</option>
    </select>
</div>
    <div class="modal-footer">
      <button type="submit" class="btn btn-primary" data-dismis="modal"><span class="d-none loader">...Loading...</span> <span class="btn_submit">Update</span></button>
    </div>
</form>
<script type="text/javascript">
	//update cupon data ajax
  $('#status_update_form').submit(function(e){
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
        $('#status_update_form')[0].reset();
        $('.loading').addClass('d-none');
        $('#ShowModal').modal('hide');
        table.ajax.reload();
      }
    });
  });
</script>