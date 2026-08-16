<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items_with_cat_map = [
            'Молочные продукты' => ['Кефир', 'Йогурт', 'Молоко', 'Сметана'],
            'Хлеб и выпечка'    => ['Батон', 'Багет'],
            'Напитки'           => ['Кола', 'Сок', 'Минералка'],
        ];

        foreach ($items_with_cat_map as $catName => $items) {
            $cat = Category::firstWhere('name', $catName);

            foreach ($items as $item) {
                Item::firstOrCreate(
                    ['name' => $item],
                    [
                        'category_id' => $cat->id,
                        'price' => rand(100, 1000),
                    ]
                );
            }
        }

        $no_cat_items = ['Зажигалка', 'Батарейки', 'Пакет-майка', 'Свечи'];

        foreach ($no_cat_items as $item) {
            Item::firstOrCreate(
                ['name' => $item],
                ['price' => rand(100, 1000)],
            );
        }
    }
}
