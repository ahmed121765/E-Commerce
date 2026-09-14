@extends('frontend.layouts.master')

@section('title')

@endsection

@section('css')
    <style>
        .table> :not(caption)>tr>th {
            padding: 0.625rem 1.5rem .625rem !important;
            background-color: #6a6e51 !important;
        }

        .table>tr>td {
            padding: 0.625rem 1.5rem .625rem !important;
        }

        .table-bordered> :not(caption)>tr>th,
        .table-bordered> :not(caption)>tr>td {
            border-width: 1px 1px;
            border-color: #6a6e51;
        }

        .table> :not(caption)>tr>td {
            padding: .8rem 1rem !important;
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
            <h2 class="page-title">Orders</h2>
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
                                <input type="hidden" name="_token" value="3v611ELheIo6fqsgspMOk0eiSZjncEeubOwUa6YT"
                                    autocomplete="off"> <a href="http://localhost:8000/logout"
                                    class="menu-link menu-link_us-s"
                                    onclick="event.preventDefault(); document.getElementById('logout-form-1').submit();">Logout</a>
                            </form>
                        </li>
                    </ul>
                </div>

                <div class="col-lg-10">
                    <div class="wg-table table-all-user">
                        <div class="table-responsive">
                            <table class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th style="width: 80px">OrderNo</th>
                                        <th>Name</th>
                                        <th class="text-center">Phone</th>
                                        <th class="text-center">Subtotal</th>
                                        <th class="text-center">Tax</th>
                                        <th class="text-center">Total</th>

                                        <th class="text-center">Status</th>
                                        <th class="text-center">Order Date</th>
                                        <th class="text-center">Items</th>
                                        <th class="text-center">Delivered On</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($orders as $order)

                                        <tr>
                                            <td class="text-center">{{ $order->id }}</td>
                                            <td class="text-center">{{ $order->name }}</td>
                                            <td class="text-center">{{ $order->phone }}</td>
                                            <td class="text-center">${{ number_format($order->subtotal, 2) }}</td>
                                            <td class="text-center">${{ number_format($order->tax, 2) }}</td>
                                            <td class="text-center">${{ number_format($order->total, 2) }}</td>

                                            <td class="text-center">
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
                                            <td class="text-center">{{ $order->created_at->format('Y-m-d H:i:s') }}</td>
                                            <td class="text-center">{{ $order->orderItems->sum('quantity') }}</td>
                                            <td>{{ $order->delivered_date ?? '' }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('order.show', $order->id) }}">
                                                    <div class="list-icon-function view-icon">
                                                        <div class="item eye">
                                                            <i class="fa fa-eye"></i>
                                                        </div>
                                                    </div>
                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="divider"></div>
                    <div class="d-flex justify-content-center mt-4">
                        {{ $orders->links('pagination::bootstrap-5') }}
                    </div>
                </div>

            </div>
        </section>
    </main>
@endsection

@section('scripts')

@endsection