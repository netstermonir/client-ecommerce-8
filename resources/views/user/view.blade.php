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
                   <h4>My All Order</h4>
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
    </div>
</div><hr>
@endsection
