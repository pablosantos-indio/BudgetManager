<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ExpenseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'category_id' => Category::factory(),
            'amount' => $this->faker->randomFloat(2, 10, 500),
            'description' => $this->faker->sentence,
            'month' => $this->faker->numberBetween(1, 12),
            'year' => $this->faker->year
        ];
    }
}
