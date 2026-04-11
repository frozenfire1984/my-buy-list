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
        Category::create(['name' => 'Бакалея', 'description' => 'Какое-то описание']);
        Category::create(['name' => 'Молочка', 'description' => 'Какое-то описание']);
        Category::create(['name' => 'Пекарня', 'description' => 'Какое-то описание']);
        Category::create(['name' => 'Мясо', 'description' => 'Какое-то описание']);
    }
}
