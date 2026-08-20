<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
use App\Models\Item;
use App\Models\User;

class ItemsPageTest extends TestCase
{
    use RefreshDatabase;

    #[TestDox('Вывод страницы с товарами')]
    public function test_items_page_successful_response(): void
    {
        $response = $this->get('/items');
        $response->assertStatus(200);
    }

    #[TestDox('Создание товара который никому не принадлежит')]
    public function test_create_and_show_item_that_does_not_belong_to_anyone(): void
    {
        Item::factory()->create([
            'name' => 'Ничейный тестовый товар',
        ]);

        $response = $this->get('/items');
        $response->assertStatus(200);
        $response->assertSee('Ничейный тестовый товар');
    }

    #[TestDox('Создание товара который принадлежит юзеру')]
    public function test_create_and_show_item_that_belong_to_user(): void
    {
        $user = User::factory()->create();
        Item::factory()->create([
            'name' => 'Тестовый товар',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/items');
        $response->assertStatus(200);
        $response->assertSee('Тестовый товар');
    }

    #[TestDox('Создание 3-х товаров которые принадлежит юзеру, проверка количества этих товаров')]
    public function test_create_and_show_3_item_that_belong_to_user(): void
    {
        $user = User::factory()->create();

        for ($n = 1; $n <= 3; $n++) {
            Item::factory()->create([
                'name' => 'Тестовый товар ' . $n,
                'user_id' => $user->id,
            ]);
        }

        $response = $this->actingAs($user)->get('/items');
        $response->assertStatus(200);
        $response->assertSee('Тестовый товар 1');
        $response->assertSee('Тестовый товар 2');
        $response->assertSee('Тестовый товар 3');
        //$response->assertSee('<p>Count of items 3</p>', false);
        //$response->assertViewHas('count', 3);

        $this->assertMatchesRegularExpression(
            '/Count of items 3(?!\d)/',
            $response->getContent()
        );
    }

    #[TestDox('Создание товара который принадлежит юзеру, и проверка этого юзера')]
    public function test_create_and_show_item_and_check_user(): void
    {
        $user = User::factory()->create([
            'name' => 'John',
        ]);
        Item::factory()->create([
            'name' => 'Тестовый товар',
            'user_id' => $user->id,
        ]);

        $response = $this->actingAs($user)->get('/items');
        $response->assertStatus(200);
        $response->assertSee('Hello John');
        $response->assertSee('Тестовый товар');
    }

    #[TestDox('Создание товара который принадлежит юзеру, и проверка что этот товар не показывается гостю')]
    public function test_create_item_and_check_that_it_dont_show_by_guest(): void
    {
        $user = User::factory()->create();

        Item::factory()->create([
            'name' => 'Тестовый товар юзера',
            'user_id' => $user->id,
        ]);

        $response = $this->get('/items');
        $response->assertStatus(200);
        $response->assertDontSee('Тестовый товар юзера');
    }
}
