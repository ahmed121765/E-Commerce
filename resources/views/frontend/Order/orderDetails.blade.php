@extends('frontend.layouts.master')

@section('title')

@endsection

@section('css')
    <style>
        .pt-90 {
            padding-top: 90px !important;
        }

        .pr-6px {
            padding-right: 6px;
            text-transform: uppercase;
        }

        .my-account .page-title {
            font-size: 1.5rem;
            font-weight: 700;
            text-transform: uppercase;
            margin-bottom: 40px;
            border-bottom: 1px solid;
            padding-bottom: 13px;
        }

        .my-account .wg-box {
            display: -webkit-box;
            display: -moz-box;
            display: -ms-flexbox;
            display: -webkit-flex;
            display: flex;
            padding: 24px;
            flex-direction: column;
            gap: 24px;
            border-radius: 12px;
            background: var(--White);
            box-shadow: 0px 4px 24px 2px rgba(20, 25, 38, 0.05);
        }

        .bg-success {
            background-color: #40c710 !important;
        }

        .bg-danger {
            background-color: #f44032 !important;
        }

        .bg-warning {
            background-color: #f5d700 !important;
            color: #000;
        }

        .table-transaction>tbody>tr:nth-of-type(odd) {
            --bs-table-accent-bg: #fff !important;

        }

        .table-transaction th,
        .table-transaction td {
            padding: 0.625rem 1.5rem .25rem !important;
            color: #000 !important;
        }

        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .25rem !important;
            background-color: #6a6e51 !important;
        }

        .table-bordered>:not(caption)>*>* {
            border-width: inherit;
            line-height: 32px;
            font-size: 14px;
            border: 1px solid #e1e1e1;
            vertical-align: middle;
        }

        .table-striped .image {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 50px;
            height: 50px;
            flex-shrink: 0;
            border-radius: 10px;
            overflow: hidden;
        }

        .table-striped td:nth-child(1) {
            min-width: 250px;
            padding-bottom: 7px;
        }

        .pname {
            display: flex;
            gap: 13px;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: #6a6e51;
        }
    </style>

    <style>
        #header {
            padding-top: 8px;
            padding-bottom: 8px;
        }

        .logo__image {
            max-width: 220px;
        }
    </style>
@endsection

@section('title_page1')

@endsection

@section('content')
    <main class="pt-90" style="padding-top: 0px;">
        <div class="mb-4 pb-4"></div>
        <section class="my-account container">
            <h2 class="page-title">Order's Details</h2>
            <div class="row">
                <div class="col-lg-2">
                    <ul class="account-nav">
                        <li><a href="{{route('home.user')}}" class="menu-link menu-link_us-s ">Dashboard</a></li>
                        <li><a href="{{route('order.index')}}" class="menu-link menu-link_us-s menu-link_active">Orders</a>
                        </li>
                        
                        <li><a href="{{ route('myaccount.index') }}" class="menu-link menu-link_us-s ">Account
                                Details</a></li>
                        <li><a href="{{ route('wishlist.index') }}" class="menu-link menu-link_us-s ">Wishlist</a>
                        </li>
                        <li>
                            <form method="POST" action="http://localhost:8000/logout" id="logout-form-1">
                                <input type="hidden" name="_token" value="3v611ELheIo6fqsgspMOk0eiSZjncEeubOwUa6YT" autocomplete="off">
                                <a href="http://localhost:8000/logout" class="menu-link menu-link_us-s"
                                    onclick="event.preventDefault(); document.getElementById('logout-form-1').submit();">Logout</a>
                            </form>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-10">
                    <div class="wg-box mt-5 mb-5">
                        <div class="row">
                            <div class="col-6">
                                <h5>Ordered Details</h5>
                            </div>
                            <div class="col-6 text-right">
                                <a class="btn btn-sm btn-danger" href="{{ route('order.index') }}">Back</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-transaction">
                                <tbody>
                                    <tr>
                                        <th>Order No</th>
                                        <td>{{$order->id}}</td>
                                        <th>Mobile</th>
                                        <td>{{ $order->phone }}</td>
                                        <th>Pin/Zip Code</th>
                                        <td>{{ $order->zip }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Date</th>
                                        <td>{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                        <th>Delivered Date</th>
                                        <td>{{ $order->delivered_date ?? '' }}</td>
                                        <th>Canceled Date</th>
                                        <td>{{$order->canceled_date ?? '' }}</td>
                                    </tr>
                                    <tr>
                                        <th>Order Status</th>
                                        <td colspan="5">
                                            @if ($order->status == 'delivered')
                                                <span class="badge bg-success">
                                                    {{ $order->status }}
                                                </span>
                                            @elseif ($order->status == 'canceled')
                                                <span class="badge bg-danger">
                                                    {{ $order->status }}
                                                </span>
                                            @else
                                                <span class="badge bg-warning">
                                                    {{ $order->status }}
                                                </span>
                                            @endif
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="wg-box wg-table table-all-user">
                        <div class="row">
                            <div class="col-6">
                                <h5>Ordered Items</h5>
                            </div>
                            <div class="col-6 text-right">

                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">Color</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Quantity</th>
                                        <th class="text-center">SKU</th>
                                        <th class="text-center">Category</th>
                                        <th class="text-center">Brand</th>
                                        
                                        <th class="text-center">Return Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                            @foreach ($order->orderItems as $item)
                                <tr>
                                    <td class="pname">
                                        <div class="image">
                                            <img src="{{ asset('uploads/Products/' . $item->product->image) }}" alt="{{ $item->product->name }}"
                                                class="image">
                                        </div>
                                        <div class="name">
                                            <a href="{{ asset('uploads/Products/' . $item->product->image) }}" target="_blank" class="body-title-2">
                                                {{ $item->product->name }}
                                            </a>
                                        </div>
                                    </td>
                                    <td class="text-center">
                                        {{ data_get($item->options, 'size_name', 'N/A') }}
                                    </td>
                                    <td class="text-center">
                                        {{ data_get($item->options, 'color_name', 'N/A') }}
                                    </td>
                                    <td class="text-center">
                                        ${{ number_format($item->price, 2) }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->quantity }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->product->SKU }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->product->category->name ?? '' }}
                                    </td>
                                    <td class="text-center">
                                        {{ $item->product->brand->name ?? '' }}
                                    </td>
                                    
                                    <td class="text-center">
                                        {{ $item->rstatus ? 'Yes' : 'No' }}
                                    </td>
                                    <td class="text-center">
                                        <div class="list-icon-function view-icon">
                                            <div class="item eye">
                                                <i class="icon-eye"></i>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="flex items-center justify-between flex-wrap gap10 wgp-pagination">

                    </div>

                    <div class="wg-box mt-5">
                        <h5>Shipping Address</h5>
                        <div class="my-account__address-item col-md-6">
                            <div class="my-account__address-item__detail">
                                <p>Name : {{ $order->name }}</p>
                                <p>Address : {{ $order->address }}</p>
                                <p>locality : {{ $order->locality }}</p>
                                <p>city : {{ $order->city }}</p>
                                <p>state : {{ $order->state }}</p>
                                <p>country : {{ $order->country }}</p>
                                <p>zip : {{ $order->zip }}</p>
                                @if ($order->landmark)
                                    <p>landmark : {{ $order->landmark }}</p>
                                @endif
                                <br>
                                <p>Mobile : {{ $order->phone }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="wg-box mt-5">
                        <h5>Transactions</h5>
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered table-transaction">
                                <tbody>
                                    <tr>
                                        <th>Subtotal</th>
                                        <td>${{ number_format($order->subtotal, 2) }}</td>
                                        <th>Tax</th>
                                        <td>${{ number_format($order->tax, 2) }}</td>
                                        <th>Discount</th>
                                        <td>${{ number_format($order->discount, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <th>Total</th>
                                        <td>${{ number_format($order->total, 2) }}</td>
                                        <th>Payment Mode</th>
                                        <td>{{ $order->transaction->mode ?? 'N/A' }}</td>
                                        <th>Status</th>
                                        <td>
                                        @if ($order->transaction?->status === 'approved')
                                            <span class="badge bg-success">
                                                {{ $order->transaction->status }}
                                            </span>
                                        @elseif ($order->transaction?->status === 'declined')
                                            <span class="badge bg-danger">
                                                {{ $order->transaction->status }}
                                            </span>
                                        @else
                                            <span class="badge bg-warning">
                                                {{ $order->transaction->status ?? 'N/A' }}
                                            </span>
                                        @endif
                                        </td>

                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    @if ($order->status === 'ordered')

                    <div class="wg-box mt-5 text-right">
                        <form action="{{ route('order.update', $order->id) }}" method="POST">
                            @csrf
                            @method('put')
                            <input type="hidden" name="status" value="canceled">
                            <button type="submit" class="btn btn-danger">Cancel Order</button>
                        </form>
                    </div>
                    @endif

                </div>

            </div>
        </section>
    </main>
@endsection

@section('scripts')

@endsection