@extends('layouts.app')
@section('content')

<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            @include('user.sidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    {{ __('Order Details') }}
                </div>

                <div class="card-body">
                   <h4>My All Order</h4><hr>
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
			                                 <span class="badge badge-primary">Order Shipped</span>
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
            </div>
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
</div><hr>
@endsection
