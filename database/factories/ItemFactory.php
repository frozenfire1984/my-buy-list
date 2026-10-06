<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Item;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'id' => $this->faker->numberBetween(1, 10000),
            'name' => $this->faker->word(),
            'price' => $this->faker->numberBetween(10, 1000),
        ];
    }

    /*public function fakeId(): static
    {
        return $this->afterMaking(
            fn (Item $item) => $item->id = fake()->unique()->numberBetween(1, 10000)
        );
    }*/
}
