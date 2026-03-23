<?php

namespace Database\Seeders;

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
        //Item::create(['name' => 'Хлеб']);
        //Item::create(['name' => 'Яйца']);
        //Item::create(['name' => 'Масло']);
        Item::factory()->count(5)->create();
    }
}
