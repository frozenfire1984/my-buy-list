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

    #[TestDox('Юзер не может посмотреть чужой товар')]
    public function test_user_dont_see_alien_item(): void
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


    #[TestDox('Юзер не может попасть на страницу редактирования чужого товара, его сразу редиректит на список товаров с вообщением "Вы пытались присвоить чужой товар"')]
    public function test_user_dont_see_alien_edit_page(): void
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
}
