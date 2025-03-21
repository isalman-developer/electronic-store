<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'category_id' => Category::inRandomOrder()->first()->id ?? Category::factory(),
            'title' => $this->faker->words(3, true),
            'brand' => $this->faker->company(),
            'description' => $this->faker->sentence(),
            'price' => $this->faker->randomFloat(2, 50, 2000),
            'stock' => $this->faker->numberBetween(0, 100),
            'weight' => $this->faker->randomFloat(2, 0.1, 10),
            'tag_number' => $this->faker->unique()->numerify('TAG-#####'),
            'status' => $this->faker->boolean(90), // 90% chance of being active
            'meta_title' => $this->faker->sentence(),
            'meta_keywords' => implode(', ', $this->faker->words(5)),
            'meta_description' => $this->faker->paragraph(),
        ];
    }
}
