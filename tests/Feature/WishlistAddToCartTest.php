<?php

namespace Tests\Feature;

use App\Models\Product;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Wearepixel\Cart\Facades\CartFacade as Cart;

class WishlistAddToCartTest extends TestCase
{
    use RefreshDatabase;

    public function test_wishlist_product_is_added_with_correct_price_quantity_and_image(): void
    {
        $user = User::factory()->create();

        $product = Product::create([
            'name' => 'Blair Reid',
            'slug' => 'blair-reid',
            'description' => 'A test product.',
            'regular_price' => 600,
            'sale_price' => 501,
            'SKU' => 'BLAIR-001',
            'stock_status' => 'instock',
            'image' => 'blair-reid.jpg',
        ]);

        $response = $this->actingAs($user)
            ->withSession(['wishlist' => [$product->id]])
            ->put(route('wishlist.update', $product));

        $response->assertRedirect(route('wishlist.index'));

        $cartItem = Cart::get($product->id);

        $this->assertNotNull($cartItem);
        $this->assertSame(501.0, (float) $cartItem->price);
        $this->assertSame(1, $cartItem->quantity);
        $this->assertSame('blair-reid.jpg', $cartItem->attributes->image);
    }

    public function test_out_of_stock_wishlist_product_is_not_added_to_cart(): void
    {
        $user = User::factory()->create();

        $product = Product::create([
            'name' => 'Unavailable Product',
            'slug' => 'unavailable-product',
            'description' => 'An unavailable test product.',
            'regular_price' => 100,
            'SKU' => 'UNAVAILABLE-001',
            'stock_status' => 'outofstock',
            'quantity' => 0,
        ]);

        $response = $this->actingAs($user)
            ->withSession(['wishlist' => [$product->id]])
            ->put(route('wishlist.update', $product));

        $response->assertRedirect(route('wishlist.index'));
        $this->assertTrue(Cart::getContent()->isEmpty());
    }
}
