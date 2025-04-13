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
