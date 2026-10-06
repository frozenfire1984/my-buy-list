<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Item;
use App\Utils\Text;

class TopItems extends Component
{

    public array $classes = [];

    public function __construct(
        public int $count = 5,
        public string $label = 'Top Items',
        public bool $isHh = false,
    )
    {
        $this->label = Text::capitalize($this->label, is_each_word: true);

        $this->classes = [
            'banner-top',
            'banner-top_hh' => $this->isHh,
        ];
    }


    public function render(): View|Closure|string
    {

        /*$items = collect([
            new Item(['name' => 'Молоко']),
            new Item(['name' => 'Хлеб']),
        ]);*/

        /*$items = collect([
            tap(new Item(['name' => 'Молоко']), fn($i) => $i->id = 1),
            tap(new Item(['name' => 'Хлеб']),   fn($i) => $i->id = 2),
        ]);*/

        //$items = Item::factory()->count(100)->fakeId()->make();

        //$items = Item::factory()->count(10)->make();

        $items = Item::with('category')
            ->whereNull('user_id')
            ->inRandomOrder()
            ->take($this->count)
            ->get();

        return view('components.top-items', ['items' => $items] );
    }
}
