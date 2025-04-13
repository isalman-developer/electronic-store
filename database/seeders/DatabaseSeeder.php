<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Order;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Models\OrderItem;
use App\Models\ProductVariant;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        // Color Seeder
        $this->call(ColorSeeder::class);

        // Size Seeder
        $this->call(SizeSeeder::class);

        // Brand Seeder
        $this->call(BrandSeeder::class);

    }
}
