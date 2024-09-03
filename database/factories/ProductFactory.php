<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Generate a random image name
        $imageName = time() . '-' . Str::slug($this->faker->word) . '.jpg';

        return [
            'name' => $this->faker->word,
            'price' => $this->faker->numberBetween(10, 1000),
            'discount' => $this->faker->numberBetween(0, 50),
            'quantity' => $this->faker->numberBetween(1, 50),
            'category_id' => $this->faker->numberBetween(1, 5), // Adjust as necessary
            'tag' => implode(',', $this->faker->words(3)),
            'image' => $imageName, // Only the image name
            'description' => $this->faker->sentence,
        ];
    }
}
