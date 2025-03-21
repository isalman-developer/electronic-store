<?php

namespace Database\Seeders;

use App\Models\Size;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('sizes')->delete();
        $sizes = ['S', 'M', 'L', 'XL'];
        foreach ($sizes as $size) {
            Size::create(['title' => $size]);
        }
    }
}
