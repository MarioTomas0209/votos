<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Comparison;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Comparison>
 */
class ComparisonFactory extends Factory
{
    protected $model = Comparison::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item1_id' => Item::inRandomOrder()->first()->id,
            'item2_id' => Item::inRandomOrder()->first()->id,
            'votes_item1' => $this->faker->numberBetween(0, 100),
            'votes_item2' => $this->faker->numberBetween(0, 100),
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
