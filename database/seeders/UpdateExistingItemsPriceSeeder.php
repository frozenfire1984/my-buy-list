<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class UpdateExistingItemsPriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Item::whereNull('price')->each(function ($item) {
            $item->update(['price' => fake()->numberBetween(10, 1000)]);
        });

    }
}
