<?php

namespace Database\Seeders;

use App\Models\Brand;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $faker = \Faker\Factory::create();


        $uniqueBrandNames = [];
        $numberOfBrands = 13;

        for ($i = 0; $i < $numberOfBrands; $i++) {
            $brandName = $faker->unique()->randomElement(Brand::$exampleBrandNames);
            $uniqueBrandNames[] = $brandName;
        }

        foreach ($uniqueBrandNames as $brandName) {
            Brand::create([
                'brand_name' => $brandName,
                'brand_image' => $faker->randomElement(Brand::$exampleImageUrls),
                'rating' => $faker->randomElement([1, 2, 3, 4, 5]),
                'country_code' => $faker->countryCode,
                'is_default' => Brand::DEFAULT_BRAND,
            ]);
        }
    }
}
