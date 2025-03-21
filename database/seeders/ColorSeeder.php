<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $colors = [
            'Black' => 'dark',
            'Yellow' => 'warning',
            'White' => 'white',
            'Red' => 'danger',
            'Green' => 'success',
            'Blue' => 'primary',
            'Sky' => 'info',
            'Gray' => 'secondary',
        ];
        foreach ($colors as $color => $colorClass) {
            Color::create([
                'title' => $color,
                'color_class' => $colorClass
            ]);
        }
    }
}
