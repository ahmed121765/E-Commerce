<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Order;
use Illuminate\Http\Request;

class orderController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $orders = Order::with('orderItems')
            ->where('user_id', auth()->id())
            ->latest()
            ->paginate(10);

        return view('frontend.Order.order', compact('orders'));
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
        ])->where('user_id', auth()->id())
            ->findOrFail($id);

        return view('frontend.order.orderDetails', compact('order'));
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
            'status' => 'required|in:canceled',

        ]);
        $order = Order::where('user_id', auth()->id())->findOrFail($id);
        $status = $request->status;
        $order->update([
            'status' => $status,
            'canceled_date' => $status === 'canceled'
                ? now()->toDateString()
                : null,
        ]);

        if ($status === 'delivered') {
            $order->transaction()->update([
                'status' => 'approved',
            ]);
        }

        return redirect()
            ->route('order.show', $order->id)
            ->with('success', 'Order canceled successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
