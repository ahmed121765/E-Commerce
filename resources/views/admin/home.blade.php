@extends('admin.layouts.master')

@section('title')

@endsection

@section('css')

@endsection

@section('title_page1')

@endsection

@section('content')
    <div class="main-content-inner">
        <div class="main-content-wrap">
            <div class="tf-section-2 mb-30">

                <div class="flex gap20 flex-wrap-mobile">

                    {{-- Left Side --}}
                    <div class="w-half">

                        {{-- Total Orders --}}
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap14">

                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>

                                    <div>
                                        <div class="body-text mb-2">
                                            Total Orders
                                        </div>

                                        <h4>
                                            {{ $totalOrders }}
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>


                        {{-- Total Amount --}}
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap14">

                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>

                                    <div>
                                        <div class="body-text mb-2">
                                            Total Amount
                                        </div>

                                        <h4>
                                            {{ number_format($totalAmount, 2) }}
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>


                        {{-- Pending Orders --}}
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap14">

                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>

                                    <div>
                                        <div class="body-text mb-2">
                                            Pending Orders
                                        </div>

                                        <h4>
                                            {{ $pendingOrders }}
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>


                        {{-- Pending Orders Amount --}}
                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap14">

                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>

                                    <div>
                                        <div class="body-text mb-2">
                                            Pending Orders Amount
                                        </div>

                                        <h4>
                                            {{ number_format($pendingAmount, 2) }}
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>


                    {{-- Right Side --}}
                    <div class="w-half">

                        {{-- Delivered Orders --}}
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap14">

                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>

                                    <div>
                                        <div class="body-text mb-2">
                                            Delivered Orders
                                        </div>

                                        <h4>
                                            {{ $deliveredOrders }}
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>


                        {{-- Delivered Orders Amount --}}
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap14">

                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>

                                    <div>
                                        <div class="body-text mb-2">
                                            Delivered Orders Amount
                                        </div>

                                        <h4>
                                            {{ number_format($deliveredAmount, 2) }}
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>


                        {{-- Canceled Orders --}}
                        <div class="wg-chart-default mb-20">
                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap14">

                                    <div class="image ic-bg">
                                        <i class="icon-shopping-bag"></i>
                                    </div>

                                    <div>
                                        <div class="body-text mb-2">
                                            Canceled Orders
                                        </div>

                                        <h4>
                                            {{ $canceledOrders }}
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>


                        {{-- Canceled Orders Amount --}}
                        <div class="wg-chart-default">
                            <div class="flex items-center justify-between">

                                <div class="flex items-center gap14">

                                    <div class="image ic-bg">
                                        <i class="icon-dollar-sign"></i>
                                    </div>

                                    <div>
                                        <div class="body-text mb-2">
                                            Canceled Orders Amount
                                        </div>

                                        <h4>
                                            {{ number_format($canceledAmount, 2) }}
                                        </h4>
                                    </div>

                                </div>

                            </div>
                        </div>

                    </div>

                </div>


                {{-- Chart --}}
                <div class="wg-box">

                    <div class="flex items-center justify-between">

                        <h5>
                            Earnings Revenue
                        </h5>

                    </div>


                    <div class="flex flex-wrap gap40">

                        {{-- Revenue --}}
                        <div>

                            <div class="mb-2">

                                <div class="block-legend">

                                    <div class="dot t1"></div>

                                    <div class="text-tiny">
                                        Revenue
                                    </div>

                                </div>

                            </div>

                            <div class="flex items-center gap10">

                                <h4>
                                    ${{ number_format($totalAmount, 2) }}
                                </h4>

                            </div>

                        </div>


                        {{-- Pending --}}
                        <div>

                            <div class="mb-2">

                                <div class="block-legend">

                                    <div class="dot t2"></div>

                                    <div class="text-tiny">
                                        Pending
                                    </div>

                                </div>

                            </div>

                            <div class="flex items-center gap10">

                                <h4>
                                    ${{ number_format($pendingAmount, 2) }}
                                </h4>

                            </div>

                        </div>


                        {{-- Delivered --}}
                        <div>

                            <div class="mb-2">

                                <div class="block-legend">

                                    <div class="dot t3"></div>

                                    <div class="text-tiny">
                                        Delivered
                                    </div>

                                </div>

                            </div>

                            <div class="flex items-center gap10">

                                <h4>
                                    ${{ number_format($deliveredAmount, 2) }}
                                </h4>

                            </div>

                        </div>


                        {{-- Canceled --}}
                        <div>

                            <div class="mb-2">

                                <div class="block-legend">

                                    <div class="dot t4"></div>

                                    <div class="text-tiny">
                                        Canceled
                                    </div>

                                </div>

                            </div>

                            <div class="flex items-center gap10">

                                <h4>
                                    ${{ number_format($canceledAmount, 2) }}
                                </h4>

                            </div>

                        </div>

                    </div>


                    {{-- ApexCharts --}}
                    <div id="line-chart-8"></div>

                </div>

            </div>
            <div class="tf-section mb-30">

                <div class="wg-box mb-30">
                    <h5>Low stock alerts ({{ $lowStockProducts->count() }})</h5>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Product</th>
                                    <th>SKU</th>
                                    <th>Quantity</th>
                                    <th>Alert At</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($lowStockProducts as $product)
                                    <tr>
                                        <td>{{ $product->name }}</td>
                                        <td>{{ $product->SKU }}</td>
                                        <td>{{ $product->quantity }}</td>
                                        <td>{{ $product->low_stock_threshold }}</td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4">No low stock products.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="wg-box">
                    <div class="flex items-center justify-between">
                        <h5>Recent orders</h5>
                        <div class="dropdown default">
                            <a class="btn btn-secondary dropdown-toggle" href="#">
                                <span class="view-all">View all</span>
                            </a>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th style="width:70px">OrderNo</th>
                                    <th class="text-center">Name</th>
                                    <th class="text-center">Phone</th>
                                    <th class="text-center">Subtotal</th>
                                    <th class="text-center">Tax</th>
                                    <th class="text-center">Total</th>

                                    <th class="text-center">Status</th>
                                    <th class="text-center">Order Date</th>
                                    <th class="text-center">Total Items</th>
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
                                        <td class="text-center">@if ($order->status == 'delivered')
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
                                            <a href="{{ route('orders.show', $order->id) }}">
                                                <div class="list-icon-function view-icon">
                                                    <div class="item eye">
                                                        <i class="icon-eye"></i>
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

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        (function ($) {

            var tfLineChart = (function () {

                var chartBar = function () {

                    var options = {

                        series: [
                            {
                                name: 'Total',
                                data: @json(collect($chartData)->pluck('total'))
                            },
                            {
                                name: 'Pending',
                                data: @json(collect($chartData)->pluck('pending'))
                            },
                            {
                                name: 'Delivered',
                                data: @json(collect($chartData)->pluck('delivered'))
                            },
                            {
                                name: 'Canceled',
                                data: @json(collect($chartData)->pluck('canceled'))
                            }
                        ],

                        chart: {
                            type: 'bar',
                            height: 325,
                            toolbar: {
                                show: false
                            }
                        },

                        plotOptions: {
                            bar: {
                                horizontal: false,
                                columnWidth: '10px',
                                endingShape: 'rounded'
                            }
                        },

                        dataLabels: {
                            enabled: false
                        },

                        legend: {
                            show: false
                        },

                        colors: [
                            '#2377FC',
                            '#FFA500',
                            '#078407',
                            '#FF0000'
                        ],

                        stroke: {
                            show: false
                        },

                        xaxis: {
                            labels: {
                                style: {
                                    colors: '#212529'
                                }
                            },

                            categories: [
                                'Jan',
                                'Feb',
                                'Mar',
                                'Apr',
                                'May',
                                'Jun',
                                'Jul',
                                'Aug',
                                'Sep',
                                'Oct',
                                'Nov',
                                'Dec'
                            ]
                        },

                        yaxis: {
                            show: false
                        },

                        fill: {
                            opacity: 1
                        },

                        tooltip: {
                            y: {
                                formatter: function (val) {
                                    return "$ " + Number(val).toFixed(2);
                                }
                            }
                        }
                    };


                    var chart = new ApexCharts(
                        document.querySelector("#line-chart-8"),
                        options
                    );


                    if ($("#line-chart-8").length > 0) {
                        chart.render();
                    }

                };


                return {

                    init: function () {
                    },

                    load: function () {
                        chartBar();
                    },

                    resize: function () {
                    }

                };

            })();


            jQuery(document).ready(function () {
            });


            jQuery(window).on("load", function () {

                tfLineChart.load();

            });


            jQuery(window).on("resize", function () {
            });


        })(jQuery);
    </script>
@endsection