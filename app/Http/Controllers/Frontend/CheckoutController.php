<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Wearepixel\Cart\Facades\CartFacade as Cart;

class CheckoutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $checkItems = Cart::getContent();

        if ($checkItems->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $subtotal = (float) Cart::getSubTotal(false);

        $totalQuantity = Cart::getTotalQuantity();

        // Get VAT from settings
        $vatSetting = Setting::where('key', 'vat')->first();

        $vatRate = (float) ($vatSetting->value ?? 0);

        // Coupon
        $coupon = session('coupon');

        $discount = 0;

        if ($coupon) {

            if ($coupon['type'] == 'percentage') {
                $discount = $subtotal * ($coupon['value'] / 100);
            } else {
                $discount = $coupon['value'];
            }

            if ($discount > $subtotal) {
                $discount = $subtotal;
            }
        }

        // Subtotal after discount
        $subtotalAfterDiscount = $subtotal - $discount;

        // VAT after discount
        $vat = $subtotalAfterDiscount * ($vatRate / 100);

        // Final total
        $total = $subtotalAfterDiscount + $vat;

        return view(
            'frontend.Checkout.checkout',
            compact(
                'checkItems',
                'subtotal',
                'total',
                'totalQuantity',
                'vatRate',
                'vat',
                'coupon',
                'discount',
                'subtotalAfterDiscount'
            )
        );
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
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'zip' => 'required|string|max:20',
            'state' => 'required|string|max:255',
            'city' => 'required|string|max:255',
            'address' => 'required|string',
            'locality' => 'required|string|max:255',
            'landmark' => 'nullable|string|max:255',
            'checkout_payment_method' => 'required|in:cod,card,paypal',
        ]);

        $checkItems = Cart::getContent();

        if ($checkItems->isEmpty()) {
            return redirect()
                ->route('cart.index')
                ->with('error', 'Your cart is empty!');
        }

        $subtotal = (float) Cart::getSubTotal(false);

        $vatSetting = Setting::where('key', 'vat')->first();
        $vatRate = (float) ($vatSetting->value ?? 0);

        $couponData = session('coupon');

        $discount = 0;
        $coupon = null;

        try {
            $orderId = DB::transaction(function () use ($request, $checkItems, $subtotal, $vatRate, $couponData, &$discount, &$coupon) {
                if ($couponData) {
                    $coupon = Coupon::whereKey($couponData['coupon_id'])
                        ->lockForUpdate()
                        ->first();

                    if (! $coupon) {
                        throw new \Exception('Coupon not found.');
                    }

                    if (! $coupon->status) {
                        throw new \Exception('Coupon is no longer active.');
                    }

                    if (
                        $coupon->expiry_date &&
                        Carbon::parse($coupon->expiry_date)->lt(Carbon::today())
                    ) {
                        throw new \Exception('Coupon has expired.');
                    }

                    if (
                        $coupon->usage_limit !== null &&
                        $coupon->used_count >= $coupon->usage_limit
                    ) {
                        throw new \Exception('Coupon usage limit has been reached.');
                    }

                    if ($subtotal < $coupon->cart_value) {
                        throw new \Exception(
                            'Minimum cart value is $'.$coupon->cart_value
                        );
                    }

                    if ($coupon->type === 'percentage') {
                        $discount = $subtotal * ($coupon->value / 100);
                    } else {
                        $discount = (float) $coupon->value;
                    }

                    if ($discount > $subtotal) {
                        $discount = $subtotal;
                    }
                }

                $subtotalAfterDiscount = $subtotal - $discount;

                $vat = $subtotalAfterDiscount * ($vatRate / 100);

                $total = $subtotalAfterDiscount + $vat;

                $order = Order::create([
                    'user_id' => auth()->id(),
                    'subtotal' => $subtotal,
                    'discount' => $discount,
                    'tax' => $vat,
                    'total' => $total,

                    'name' => $request->name,
                    'phone' => $request->phone,
                    'locality' => $request->locality,
                    'address' => $request->address,
                    'city' => $request->city,
                    'state' => $request->state,
                    'country' => 'Egypt',
                    'landmark' => $request->landmark,
                    'zip' => $request->zip,

                    'type' => 'home',
                    'status' => 'ordered',
                    'is_shipping_different' => false,
                ]);

                foreach ($checkItems as $item) {
                    $product = Product::whereKey($item->id)
                        ->lockForUpdate()
                        ->first();

                    if (
                        ! $product ||
                        $product->stock_status !== 'instock' ||
                        $product->quantity < $item->quantity
                    ) {
                        throw new \Exception("Product {$item->name} is out of stock.");
                    }

                    $product->decrement('quantity', (int) $item->quantity);
                    $product->update([
                        'stock_status' => $product->quantity === 0
                            ? 'outofstock'
                            : 'instock',
                    ]);

                    OrderItem::create([
                        'product_id' => $item->attributes->product_id ?? $product->id,
                        'order_id' => $order->id,
                        'price' => $item->price,
                        'quantity' => $item->quantity,
                        'options' => $item->attributes?->toArray() ?? [],
                        'rstatus' => false,
                    ]);
                }

                Transaction::create([
                    'user_id' => auth()->id(),
                    'order_id' => $order->id,
                    'mode' => $request->checkout_payment_method,
                    'status' => $request->checkout_payment_method === 'cod'
                        ? 'approved'
                        : 'pending',
                ]);

                if ($coupon) {
                    $coupon->increment('used_count');
                }

                return $order->id;
            });
        } catch (\Exception $exception) {
            return redirect()
                ->route('cart.index')
                ->with('error', $exception->getMessage());
        }

        session()->forget('coupon');

        Cart::clear();

        return redirect()
            ->route('checkout.confirmation', ['id' => $orderId])
            ->with(
                'success',
                'Your order has been placed successfully!'
            );
    }

    public function confirmation(string $id)
    {
        $order = Order::with([
            'orderItems.product',
            'transaction',
        ])
            ->where('user_id', auth()->id())
            ->findOrFail($id);

        return view(
            'frontend.Checkout.orderConfirmation',
            compact('order')
        );
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
