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

        // Create 5 categories
        // Category::factory(5)->create();

        // // Create 20 products
        // Product::factory(20)->create();

        // // Create 50 product variants
        // ProductVariant::factory(50)->create();

        // Color Seeder
        $this->call(ColorSeeder::class);

        // Size Seeder
        $this->call(SizeSeeder::class);


        // Create 30 orders
        // Order::factory(30)->create();

        // Create 60 order items
        // OrderItem::factory(60)->create();

        // Create 40 reviews
        // Review::factory(40)->create();
    }
}
