<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css">
</head>
<body>
    <div class="offset-xl-2 col-xl-8 col-lg-12 col-md-12 col-sm-12 col-12 padding">
        <div class="card">
            <div class="card-header p-4">
                <a class="pt-2 d-inline-block" href="{{ url('/') }}" data-abc="true">Ecommerce.com</a>
                <div class="float-right">
                    <h3 class="mb-0">Invoice {{ $order['order_id'] }}</h3>
                    Date: {{ $order['date'] }}
                </div>
            </div>
            <div class="card-body">
                <div class="row mb-4">
                    <div class="col-sm-6">
                        <h5 class="mb-3">From:</h5>
                        <h3 class="text-dark mb-1">Tejinder Singh</h3>
                        <div>29, Singla Street</div>
                        <div>Sikeston,New Delhi 110034</div>
                        <div>Email: contact@bbbootstrap.com</div>
                        <div>Phone: +91 9897 989 989</div>
                    </div>
                    <div class="col-sm-6 ">
                        <h5 class="mb-3">To:</h5>
                        <h3 class="text-dark mb-1">Akshay Singh</h3>
                        <div>478, Nai Sadak</div>
                        <div>Chandni chowk, New delhi, 110006</div>
                        <div>Email: info@tikon.com</div>
                        <div>Phone: +91 9895 398 009</div>
                    </div>
                </div>
                <div class="table-responsive-sm">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th class="center">No</th>
                                <th class="center">Image</th>
                                <th>Item</th>
                                <th class="right">Color</th>
                                <th class="right">Size</th>
                                <th class="center">Qty</th>
                                <th class="right">Price</th>
                            </tr>
                        </thead>
                        @php
                            $total = 0;
                            // $order_details = json_decode($order['order_details'], true);
                            $order_details = DB::table('order_details')->get();

                        @endphp
                        <tbody>
                            @foreach ($order_details as $row)
                            <tr>
                                <td class="center">{{ $total++ }}</td>
                                <td class="center">
                                    <img src="{{ asset('public/files/product/'.$row->product_image) }}" alt="{{ $row->product_name }}" width="60">
                                </td>
                                <td class="left strong">{{ $row->product_name }}</td>
                                <td class="right">{{ $row->color }}</td>
                                <td class="right">{{ $row->size }}</td>
                                <td class="center">{{ $row->quantity }}</td>
                                <td class="right">{{ $row->product_price }}{{ $setting->currency }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div class="col-lg-4 col-sm-5">
                    </div>
                    <div class="col-lg-4 col-sm-5 ml-auto">
                        <table class="table table-clear">
                            <tbody>

                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Shipping</strong>
                                    </td>
                                    <td class="right">{{ $order['shipping_charge'] }}{{ $setting->currency }}</td>
                                </tr>
                                <tr>
                                    <td class="left">
                                        <strong class="text-dark">Tax</strong>
                                    </td>
                                    <td class="right">{{ $order['tax'] }}{{ $setting->currency }}</td>
                                </tr>
                                {{-- <tr>
                                    <td class="left">
                                        <strong class="text-dark">Total</strong>
                                    </td>
                                    <td class="right">{{ $row->subtotal_price }}{{ $setting->currency }}</td>
                                </tr> --}}
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer bg-white">
                <p class="mb-0">BBBootstrap.com, Sounth Block, New delhi, 110034</p>
            </div>
        </div>
    </div>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.bundle.min.js"></script>
</body>
</html>
