<?php

namespace Tests\Feature;

use App\Models\Admin;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class AdminAuthenticationTest extends TestCase
{
    use RefreshDatabase;

    public function test_admin_login_screen_can_be_rendered(): void
    {
        $response = $this->get(route('admin.login'));

        $response->assertOk();
    }

    public function test_admin_can_authenticate_using_the_admin_login_screen(): void
    {
        $admin = Admin::create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
            'password' => Hash::make('password'),
        ]);

        $response = $this->post(route('login.admin.store'), [
            'email' => $admin->email,
            'password' => 'password',
        ]);

        $response->assertRedirect(route('home.admin'));
        $this->assertAuthenticatedAs($admin, 'admin');
    }

    public function test_admin_login_rejects_a_user_account(): void
    {
        $response = $this->post(route('login.admin.store'), [
            'email' => 'user@example.com',
            'password' => 'password',
        ]);

        $response->assertSessionHasErrors('email');
        $this->assertGuest('admin');
    }
}
