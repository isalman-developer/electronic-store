<?php

namespace Database\Seeders;

use App\Models\Color;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ColorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('colors')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $colors = [
            'Black' => ['class' => 'dark', 'hex' => '#000000'],
            'Yellow' => ['class' => 'warning', 'hex' => '#FFFF00'],
            'White' => ['class' => 'white', 'hex' => '#FFFFFF'],
            'Red' => ['class' => 'danger', 'hex' => '#FF0000'],
            'Green' => ['class' => 'success', 'hex' => '#008000'],
            'Blue' => ['class' => 'primary', 'hex' => '#0000FF'],
            'Sky' => ['class' => 'info', 'hex' => '#87CEEB'],
            'Gray' => ['class' => 'secondary', 'hex' => '#808080'],
        ];
        foreach ($colors as $color => $attributes) {
            Color::create([
                'title' => $color,
                'color_class' => $attributes['class'],
                'hex_code' => $attributes['hex']
            ]);
        }
    }
}
