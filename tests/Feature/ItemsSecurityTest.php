<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use PHPUnit\Framework\Attributes\TestDox;
use App\Models\Item;
use App\Models\User;

class ItemsSecurityTest extends TestCase
{
    use RefreshDatabase;

    #[TestDox('Злоумышленник не может посмотреть чужой товар')]
    public function test_attacker_dont_see_alien_item(): void
    {
        $user = User::factory()->create();
        $itemOfUser = Item::factory()->create([
            'name' => 'Тестовый товар Васи',
            'user_id' => $user->id,
        ]);

        $userAttacker = User::factory()->create();
        $response = $this->actingAs($userAttacker)->get(route('buy-list.show', $itemOfUser->id));
        $response->assertStatus(403);
        $response->assertDontSee('Тестовый товар Васи');
    }


    #[TestDox('Злоумышленник не может попасть на страницу редактирования чужого товара, его сразу редиректит на список товаров с сообщением "Вы пытались присвоить чужой товар"')]
    public function test_attacker_dont_see_alien_edit_page(): void
    {
        $user = User::factory()->create();
        $itemOfUser = Item::factory()->create([
            'name' => 'Тестовый товар Васи',
            'user_id' => $user->id,
        ]);

        $userAttacker = User::factory()->create();
        $response = $this->actingAs($userAttacker)->get(route('buy-list.edit', $itemOfUser->id));
        $response->assertRedirect(route('buy-list.claim', $itemOfUser->id));
        $response->assertSessionHas('success', 'Подтвердите если хотите присвоить этот товар себе');


        //$response = $this->actingAs($userAttacker)->get(route('buy-list.claim', $itemOfUser->id));
        $response = $this->get(route('buy-list.claim', $itemOfUser->id));
        $response->assertRedirect(route('buy-list.index'));
        $response->assertSessionHas('error', 'Вы пытались присвоить чужой товар');

        $response = $this->actingAs($userAttacker)
            ->followingRedirects()
            ->get(route('buy-list.edit', $itemOfUser->id));
        $response->assertDontSee('Тестовый товар Васи');
    }

    #[TestDox('Злоумышленник не может похитить чужой товар')]
    public function test_attacker_dont_steal_alien_item(): void
    {
        $user = User::factory()->create();
        $itemOfUser = Item::factory()->create([
            'name' => 'Тестовый товар Васи',
            'user_id' => $user->id,
            'price' => '1000'
        ]);

        $body = [
            'name' => 'Взломано!',
            'price' => '1',
        ];

        $headers = [
            //'Content-Type' => 'application/json',
            //'Accept' => 'application/json',
        ];

        $userAttacker = User::factory()->create();
        $response = $this->actingAs($userAttacker)
            ->withHeaders($headers)
            ->put(route('buy-list.update', $itemOfUser->id), $body);

        $response->assertStatus(403);


        $this->actingAs($userAttacker)->get(route('buy-list.index'))->assertDontSee('Взломано!');;
        $this->actingAs($userAttacker)->get(route('buy-list.index'))->assertDontSee('Тестовый товар Васи');


        $this->assertDatabaseHas('items', [
            'user_id' => $user->id,
            'name' => 'Тестовый товар Васи',
            'price' => 1000
        ]);
        $this->actingAs($user)->get(route('buy-list.index'))->assertSee('Тестовый товар Васи');
    }
}
