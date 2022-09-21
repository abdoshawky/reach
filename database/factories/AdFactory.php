<?php

namespace Database\Factories;

use App\Models\Ad;
use App\Models\Advertiser;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class AdFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition(): array
    {
        return [
            'advertiser_id' => Advertiser::factory()->create(),
            'category_id' => Category::factory()->create(),
            'type' => $this->faker->randomElement([Ad::TYPE_FREE, Ad::TYPE_PAID]),
            'title' => $this->faker->words(mt_rand(1, 5), true),
            'description' => $this->faker->paragraphs(mt_rand(1, 3), true),
            'start_date' => $this->faker->dateTimeBetween('+0 days', '+1 month'), // date in the future
        ];
    }
}
