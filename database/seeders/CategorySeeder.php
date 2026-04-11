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
        Category::firstOrCreate(['name' => 'Алкоголь'], ['description' => 'Какое-то описание']);
        Category::firstOrCreate(['name' => 'Хозтовары'], ['description' => 'Какое-то описание']);
        Category::firstOrCreate(['name' => 'Химия'], ['description' => 'Какое-то описание']);
        Category::firstOrCreate(['name' => 'Авто-товары'], ['description' => 'Какое-то описание']);
    }
}
