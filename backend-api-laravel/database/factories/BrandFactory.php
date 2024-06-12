<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Brand>
 */
class BrandFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'brand_name' => fake()->randomElement(Brand::$exampleBrandNames),
            'brand_image' => fake()->randomElement(Brand::$exampleImageUrls),
            'rating' => fake()->randomElement([1, 2, 3, 4, 5]),
            'country_code' => fake()->countryCode,
            'is_default' => Brand::DEFAULT_BRAND,
        ];
    }
}
