<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InventoryAlertTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_lists_products_at_or_below_their_low_stock_threshold(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'inventory@example.com',
            'password' => bcrypt('password'),
        ]);

        Product::create([
            'name' => 'Low Stock Product',
            'slug' => 'low-stock-product',
            'description' => 'A product with low inventory.',
            'regular_price' => 100,
            'SKU' => 'LOW-001',
            'quantity' => 2,
            'low_stock_threshold' => 5,
            'stock_status' => 'instock',
        ]);

        $response = $this->actingAs($admin, 'admin')->get(route('home.admin'));

        $response->assertOk()->assertSee('Low Stock Product')->assertSee('LOW-001');
    }
}
