<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Item;
use App\Models\User;

class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $items_with_cat_map = [
            'Алкоголь'          => ['Пиво Зайчарское', 'Пиво Jelen', 'Пиво Law', 'Сидр Somersby'],
            'Крепкий алкоголь'  => ['Водка', 'Виски', 'Jagermeister', 'Gorky List'],
            'Сигареты'          => ['Marlboro', 'Беломор Канал'],

            'Молочные продукты' => ['Кефир', 'Йогурт', 'Молоко', 'Сметана'],
            'Хлеб и выпечка'    => ['Батон', 'Багет', 'Круасаны'],

            'Напитки'           => ['Coca Cola', 'Sprite', 'Fanta', 'Князь Милош'],
            'Сладости'          => ['Snickers', 'Mars', 'Рулет', 'Торт'],

            'Сувениры'          => ['Магнитик', 'Матрешка'],
        ];

        // preferences, not category belongs
        $cat_preferences = [
            'Алкоголь'          => 'vasya@example.com',
            'Крепкий алкоголь'  => 'vasya@example.com',
            'Сигареты'          => 'vasya@example.com',

            'Молочные продукты' => 'john@example.com',
            'Хлеб и выпечка'    => 'john@example.com',

            'Сладости'          => 'alex@example.com',
            'Напитки'           => 'alex@example.com',
        ];

        foreach ($items_with_cat_map as $catName => $items) {
            $cat = Category::firstWhere('name', $catName);

            $ownerEmail = $cat_preferences[$catName] ?? null;
            $owner = $ownerEmail ? User::firstWhere("email", $ownerEmail) : null;

            foreach ($items as $item) {
                Item::firstOrCreate(
                    ['name' => $item],
                    [
                        'category_id' => $cat->id,
                        'price' => rand(100, 1000),
                        'user_id' => $owner?->id,
                    ]
                );
            }
        }

        /* items without category */
        $no_cat_items = ['Зажигалка', 'Батарейки', 'Пакет-майка', 'Свечи'];

        foreach ($no_cat_items as $item) {
            Item::firstOrCreate(
                ['name' => $item],
                ['price' => rand(100, 1000)],
            );
        }

        /* items without category, but with owner */

        $vasya_owner = User::firstWhere("email", 'vasya@example.com');
        $vasya_items = ['Пепельница', 'Открывашка', 'Кальян'];

        foreach ($vasya_items as $item) {
            Item::firstOrCreate(
                ['name' => $item],
                [
                    'price' => rand(100, 1000),
                    'user_id' => $vasya_owner->id,
                ],
            );
        }
    }
}
