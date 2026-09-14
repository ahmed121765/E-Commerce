<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [
            [
                'name' => 'Black',
                'hex_code' => '#000000',
            ],
            [
                'name' => 'White',
                'hex_code' => '#FFFFFF',
            ],
            [
                'name' => 'Red',
                'hex_code' => '#FF0000',
            ],
            [
                'name' => 'Blue',
                'hex_code' => '#0000FF',
            ],
            [
                'name' => 'Green',
                'hex_code' => '#008000',
            ],
        ];

        foreach ($colors as $color) {
            Color::firstOrCreate(
                ['name' => $color['name']],
                ['hex_code' => $color['hex_code']]
            );
        }
    }
}
