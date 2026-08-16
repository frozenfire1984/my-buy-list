<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $names = [
            'Молочные продукты', 'Мясо и птица', 'Рыба и морепродукты',
            'Овощи и фрукты', 'Хлеб и выпечка', 'Бакалея', 'Напитки',
            'Алкоголь', 'Снеки и сладости', 'Замороженные продукты',
            'Консервы', 'Хозтовары', 'Бытовая химия', 'Автохимия',
            'Личная гигиена', 'Детские товары', 'Товары для животных',
            'Игрушки и сувениры', 'Канцелярия',
        ];

        foreach ($names as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['description' => fake()->sentence()],
            );
        }
    }
}
