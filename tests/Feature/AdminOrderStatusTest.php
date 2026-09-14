<?php

namespace Tests\Feature;

use App\Models\Admin;
use App\Models\Order;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AdminOrderStatusTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_dashboard_displays_order_statistics(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'dashboard@example.com',
            'password' => 'password',
        ]);
        $user = User::factory()->create();

        foreach ([
            ['total' => 110, 'status' => 'ordered'],
            ['total' => 220, 'status' => 'delivered'],
            ['total' => 70, 'status' => 'canceled'],
        ] as $orderData) {
            Order::create([
                'user_id' => $user->id,
                'subtotal' => $orderData['total'],
                'tax' => 0,
                'total' => $orderData['total'],
                'name' => 'Test User',
                'phone' => '123456789',
                'locality' => 'Test Locality',
                'address' => 'Test Address',
                'city' => 'Test City',
                'state' => 'Test State',
                'country' => 'Test Country',
                'zip' => '12345',
                'status' => $orderData['status'],
            ]);
        }

        $response = $this->actingAs($admin, 'admin')->get(route('home.admin'));

        $response->assertOk();
        $response->assertSee('3');
        $response->assertSee('400.00');
        $response->assertSee('110.00');
        $response->assertSee('220.00');
        $response->assertSee('70.00');
        $response->assertViewHas('chartData', function ($chartData): bool {
            $currentMonth = now()->month - 1;

            return $chartData[$currentMonth]['total'] === 400.0
                && $chartData[$currentMonth]['pending'] === 110.0
                && $chartData[$currentMonth]['delivered'] === 220.0
                && $chartData[$currentMonth]['canceled'] === 70.0;
        });
    }

    public function test_delivering_an_order_approves_its_transaction(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => 'password',
        ]);
        $user = User::factory()->create();
        $order = Order::create([
            'user_id' => $user->id,
            'subtotal' => 100,
            'tax' => 10,
            'total' => 110,
            'name' => 'Test User',
            'phone' => '123456789',
            'locality' => 'Test Locality',
            'address' => 'Test Address',
            'city' => 'Test City',
            'state' => 'Test State',
            'country' => 'Test Country',
            'zip' => '12345',
            'status' => 'ordered',
        ]);
        $transaction = Transaction::create([
            'mode' => 'card',
            'status' => 'pending',
            'user_id' => $user->id,
            'order_id' => $order->id,
        ]);

        $response = $this
            ->actingAs($admin, 'admin')
            ->put(route('orders.update', $order), ['status' => 'delivered']);

        $response->assertRedirect(route('orders.show', $order));
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status' => 'delivered',
        ]);
        $this->assertDatabaseHas('transactions', [
            'id' => $transaction->id,
            'status' => 'approved',
        ]);
    }
}
