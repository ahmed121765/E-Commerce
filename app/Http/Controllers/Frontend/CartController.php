<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Product;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Wearepixel\Cart\Facades\CartFacade as Cart;

class CartController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Cart Page
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        $cartItems = Cart::getContent();

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
            'frontend.Cart.cart',
            compact(
                'cartItems',
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

    /*
    |--------------------------------------------------------------------------
    | Apply Coupon
    |--------------------------------------------------------------------------
    */

    public function applyCoupon(Request $request)
    {
        $request->validate([
            'coupon_code' => 'required',
        ]);

        $coupon = Coupon::where('code', $request->coupon_code)->first();

        if (! $coupon) {
            return back()->with(
                'error',
                'Coupon code is invalid!'
            );
        }

        if (! $coupon->status) {
            return back()->with(
                'error',
                'Coupon is inactive!'
            );
        }

        if (
            $coupon->expiry_date &&
            Carbon::parse($coupon->expiry_date)->lt(Carbon::today())
        ) {
            return back()->with(
                'error',
                'Coupon has expired!'
            );
        }

        if (
            $coupon->usage_limit !== null &&
            $coupon->used_count >= $coupon->usage_limit
        ) {
            return back()->with(
                'error',
                'Coupon usage limit has been reached!'
            );
        }

        $subtotal = (float) Cart::getSubTotal(false);

        if ($subtotal < $coupon->cart_value) {
            return back()->with(
                'error',
                'Minimum cart value is $'.$coupon->cart_value
            );
        }

        session()->put('coupon', [
            'code' => $coupon->code,
            'type' => $coupon->type,
            'value' => $coupon->value,
            'cart_value' => $coupon->cart_value,
            'coupon_id' => $coupon->id,
        ]);

        return back()->with(
            'success',
            'Coupon applied successfully!'
        );
    }

    /*
    |--------------------------------------------------------------------------
    | Add Product To Cart
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
            'quantity' => 'required|integer|min:1',
            'size_id' => 'nullable|exists:sizes,id',
            'color_id' => 'nullable|exists:colors,id',
        ]);

        $product = Product::findOrFail($request->product_id);

        if ($product->sizes()->exists() && ! $request->size_id) {

            return back()->with(
                'error',
                'Please select a size.'
            );
        }

        if ($product->colors()->exists() && ! $request->color_id) {
            return back()->with('error', 'Please select a color.');
        }

        // Check product stock
        if ($product->stock_status !== 'instock') {

            return back()->with(
                'error',
                'This product is out of stock.'
            );
        }

        // Get selected size
        $size = null;

        if ($request->size_id) {

            $size = $product->sizes()
                ->where('sizes.id', $request->size_id)
                ->first();

            if (! $size) {

                return back()->with(
                    'error',
                    'The selected size is not available for this product.'
                );
            }
        }

        $color = null;

        if ($request->color_id) {
            $color = $product->colors()
                ->where('colors.id', $request->color_id)
                ->first();

            if (! $color) {
                return back()->with(
                    'error',
                    'The selected color is not available for this product.'
                );
            }
        }

        // Requested quantity
        $requestedQuantity = (int) $request->quantity;

        // Create unique cart ID
        $cartItemId = $product->id;

        if ($request->size_id) {
            $cartItemId .= '-'.$request->size_id;
        }

        if ($request->color_id) {
            $cartItemId .= '-'.$request->color_id;
        }

        // Check existing cart item
        $cartItem = Cart::getContent()->get($cartItemId);

        $cartQuantity = (int) ($cartItem->quantity ?? 0);

        // Check stock quantity
        if ($cartQuantity + $requestedQuantity > $product->quantity) {

            return back()->with(
                'error',
                'The requested quantity is not available.'
            );
        }

        // Product price
        $price = $product->sale_price ?? $product->regular_price;

        // Add product to cart
        Cart::add(
            $cartItemId,
            $product->name,
            $price,
            $requestedQuantity,
            [
                'image' => $product->image,
                'product_id' => $product->id,
                'size_id' => $size?->id,
                'size_name' => $size?->name,
                'color_id' => $color?->id,
                'color_name' => $color?->name,
            ]
        );

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Product added to cart successfully'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Update Cart Quantity
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, string $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        // Get cart item
        $cartItem = Cart::getContent()->get($id);

        if (! $cartItem) {

            return response()->json([
                'success' => false,
                'message' => 'Cart item not found.',
            ], 404);
        }

        // Get original product ID
        $productId = $cartItem->attributes->product_id;

        $product = Product::find($productId);

        // Check product
        if (! $product || $product->stock_status !== 'instock') {

            return response()->json([
                'success' => false,
                'message' => 'This product is out of stock.',
            ], 422);
        }

        $quantity = (int) $request->quantity;

        // Check stock
        if ($quantity > $product->quantity) {

            return response()->json([
                'success' => false,
                'message' => 'The requested quantity is not available.',
            ], 422);
        }

        // Update cart
        Cart::update($id, [
            'quantity' => [
                'relative' => false,
                'value' => $quantity,
            ],
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Cart updated successfully',
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | Remove Product From Cart
    |--------------------------------------------------------------------------
    */

    public function destroy(string $id)
    {
        Cart::remove($id);

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Product removed from cart'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Clear Cart
    |--------------------------------------------------------------------------
    */

    public function clear()
    {
        Cart::clear();

        return redirect()
            ->route('cart.index')
            ->with(
                'success',
                'Cart cleared successfully'
            );
    }

    /*
    |--------------------------------------------------------------------------
    | Remove Coupon
    |--------------------------------------------------------------------------
    */

    public function removeCoupon(Request $request)
    {

        $request->session()->forget('coupon');

        return redirect()->route('cart.index')->with('success', 'Coupon removed successfully!');
    }
}
