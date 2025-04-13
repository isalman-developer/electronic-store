<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Disable foreign key checks, truncate the table, and re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('brands')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('brands')->insert([
            'title' => 'Brand 1',
            'slug' => "brand-1",
            'status' => 1,
            'description' => 'Description of brand 1',
        ]);
    }
}
