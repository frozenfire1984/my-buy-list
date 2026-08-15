<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ItemsPageTest extends TestCase
{
    use RefreshDatabase;

    public function test_items_page_successful_response(): void
    {
        $response = $this->get('/items');
        $response->assertStatus(200);
    }


    public function test_create_and_show_item_whish_does_not_belong_to_anyone(): void
    {

        $item = \App\Models\Item::factory()->create([
            'name' => 'Ничейный тестовый товар',
        ]);

        $response = $this->get('/items');
        $response->assertStatus(200);
        $response->assertSee('Ничейный тестовый товар');
    }
}
