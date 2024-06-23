<?php

namespace Database\Factories;

use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        $imageFileName = Str::random(10) . '_' . time() . '.webp'; // Genera un nombre único para la imagen

        return [
            'name' => $this->faker->word,
            'type' => $this->faker->randomElement(['bebida', 'comida']),
            'image_url' => 'items/' . $imageFileName,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
}
