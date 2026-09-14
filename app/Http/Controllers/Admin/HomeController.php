<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;

class HomeController extends Controller
{
    public function index()
    {
        $orders = Order::with('orderItems')->orderByDesc('created_at')->take(10)->get();
        // Total Orders
        $totalOrders = Order::count();
        // Total Amount
        $totalAmount = Order::sum('total');
        // Pending Orders
        $pendingOrders = Order::where('status', 'ordered')->count();
        // Pending Amount
        $pendingAmount = Order::where('status', 'ordered')->sum('total');
        // Delivered Orders
        $deliveredOrders = Order::where('status', 'delivered')->count();
        // Delivered Amount
        $deliveredAmount = Order::where('status', 'delivered')->sum('total');
        // Canceled Orders
        $canceledOrders = Order::where('status', 'canceled')->count();
        // Canceled Amount
        $canceledAmount = Order::where('status', 'canceled')->sum('total');
        $lowStockProducts = Product::whereColumn('quantity', '<=', 'low_stock_threshold')
            ->orderBy('quantity')
            ->get();
        /*
        |--------------------------------------------------------------------------
        | Chart Data
        |--------------------------------------------------------------------------
        */
        $chartData = [];
        for ($month = 1; $month <= 12; $month++) {
            $chartData[] = [
                // All orders in this month
                'total' => (float) Order::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', $month)
                    ->sum('total'),
                // Pending orders in this month
                'pending' => (float) Order::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', $month)
                    ->where('status', 'ordered')
                    ->sum('total'),
                // Delivered orders in this month
                'delivered' => (float) Order::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', $month)
                    ->where('status', 'delivered')
                    ->sum('total'),
                // Canceled orders in this month
                'canceled' => (float) Order::whereYear('created_at', now()->year)
                    ->whereMonth('created_at', $month)
                    ->where('status', 'canceled')
                    ->sum('total'),
            ];
        }

        return view('admin.home', compact(
            'totalOrders',
            'totalAmount',
            'orders',
            'pendingOrders',
            'pendingAmount',
            'deliveredOrders',
            'deliveredAmount',
            'canceledOrders',
            'canceledAmount',
            'chartData',
            'lowStockProducts'
        ));
    }
}
