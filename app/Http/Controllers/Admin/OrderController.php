<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('orderItems')
            ->latest()
            ->paginate(10);

        return view('admin.order.order', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $order = Order::with([
            'orderItems.product',
            'transaction',
        ])->findOrFail($id);

        return view('admin.order.orderDetails', compact('order'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'status' => 'required|in:ordered,delivered,canceled',
        ]);
        $order = Order::findOrFail($id);
        $status = $request->status;
        $order->update([
            'status' => $status,
            'delivered_date' => $status === 'delivered' ? now()->toDateString() : null,
            'canceled_date' => $status === 'canceled' ? now()->toDateString() : null,
        ]);

        if ($status === 'delivered') {
            $order->transaction()->update([
                'status' => 'approved',
            ]);
        }

        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', 'Order status updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
