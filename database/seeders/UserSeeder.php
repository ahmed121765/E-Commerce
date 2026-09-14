<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('users')->delete();

        $User = [
            [
                'name' => 'User',
                'email' => 'ahmed14015320@gmail.com',
                'password' => Hash::make('ahmed14015320'),
            ],
            [
                'name' => 'User',
                'email' => 'ahmedashraf12178@gmail.com',
                'password' => Hash::make('ahmedashraf12178'),
            ],
        ];

        User::insert($User);

    }
}
