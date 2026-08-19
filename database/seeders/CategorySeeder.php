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
            'Алкоголь', 'Крепкий алкоголь', 'Сигареты',
            'Молочные продукты', 'Хлеб и выпечка',
            'Сладости', 'Напитки',
            //'Снеки', 'Мороженое',
            //'Мясо и птица', 'Рыба и морепродукты', 'Овощи и фрукты',
            //'Консервы', 'Замороженные продукты', 'Бакалея',
            //'Хозтовары', 'Бытовая химия', 'Автохимия',
            //'Личная гигиена', 'Детские товары', 'Товары для животных',
            //'Игрушки', 'Канцелярия',
            'Сувениры',
        ];

        foreach ($names as $name) {
            Category::firstOrCreate(
                ['name' => $name],
                ['description' => fake()->sentence()],
            );
        }
    }
}
