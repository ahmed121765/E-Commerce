<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Wearepixel\Cart\Facades\CartFacade as Cart;

class WishlistController extends Controller
{
    public function index()
    {
        $wishlistIds = session('wishlist', []);

        $wishlists = Product::whereIn('id', $wishlistIds)->get();

        return view('frontend.Wishlist.wishlist', compact('wishlists'));
    }

    public function store(Request $request)
    {
        $product = Product::findOrFail($request->product_id);

        $wishlist = session('wishlist', []);

        if (! in_array($product->id, $wishlist)) {
            $wishlist[] = $product->id;
        }

        session(['wishlist' => $wishlist]);

        return redirect()
            ->route('wishlist.index')
            ->with('success', 'Product added to wishlist');
    }

    public function update(string $id)
    {
        $product = Product::where('id', $id)->firstOrFail();

        if ($product->stock_status !== 'instock' || $product->quantity < 1) {
            return redirect()
                ->route('wishlist.index')
                ->with('error', 'This product is out of stock.');
        }

        $cartItem = Cart::getContent()->get($product->id);

        if ((int) ($cartItem->quantity ?? 0) >= $product->quantity) {
            return redirect()
                ->route('wishlist.index')
                ->with('error', 'The requested quantity is not available.');
        }

        Cart::add(
            $product->id,
            $product->name,
            $product->sale_price ?? $product->regular_price,
            1,
            [
                'image' => $product->image,
            ]
        );

        $wishlist = session('wishlist', []);

        $wishlist = array_values(
            array_filter(
                $wishlist,
                fn ($wishlistId) => $wishlistId != $id
            )
        );

        session(['wishlist' => $wishlist]);

        return redirect()
            ->route('wishlist.index')
            ->with('success', 'Product added to cart');
    }

    public function destroy(string $id)
    {
        $wishlist = session('wishlist', []);

        $wishlist = array_values(
            array_filter(
                $wishlist,
                fn ($wishlistId) => $wishlistId != $id
            )
        );

        session(['wishlist' => $wishlist]);

        return redirect()
            ->route('wishlist.index')
            ->with(
                'success',
                'Product removed from wishlist'
            );
    }

    public function clear()
    {
        session()->forget('wishlist');

        return redirect()
            ->route('wishlist.index')
            ->with(
                'success',
                'Wishlist cleared successfully'
            );
    }
}
