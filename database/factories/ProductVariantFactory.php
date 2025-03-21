<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\ProductVariant;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ProductVariant>
 */
class ProductVariantFactory extends Factory
{
    protected $model = ProductVariant::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id ?? Product::factory(),
            'variant_name' => $this->faker->randomElement(['Color', 'Storage']),
            'variant_value' => $this->faker->randomElement(['Red', 'Blue', '64GB', '128GB']),
            'price' => $this->faker->randomFloat(2, 50, 500),
            'stock' => $this->faker->numberBetween(1, 50),
        ];
    }
}
