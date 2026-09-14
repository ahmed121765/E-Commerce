<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use InvalidArgumentException;

class AdminSeeder extends Seeder
{
    public function run(): void
    {
        $email = env('ADMIN_EMAIL');
        $password = env('ADMIN_PASSWORD');

        if (!is_string($email) || $email === '' || !is_string($password) || $password === '') {
            throw new InvalidArgumentException('ADMIN_EMAIL and ADMIN_PASSWORD must be configured before seeding admins.');
        }

        Admin::updateOrCreate(
            ['email' => $email],
            [
                'name' => env('ADMIN_NAME', 'Admin'),
                'password' => Hash::make($password),
            ],
        );

    }
}
