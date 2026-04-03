<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Item;

class BuyListController extends Controller
{
    public function index() {
        $items = Item::all();
        $count = $items->count();
        return view('buy-list', [
            'items' => $items,
            'count' => $count,
            'meta' => [
                'title' => "Items page",
                'description' => "Lorem ipsum dolor sit amet",
                'keywords' => "Lorem, ipsum, dolor, sit, amet"
            ]
        ]);
    }

    public function show($id) {
        $item = Item::findOrFail($id);
        return view('buy-list-details', [
            'item' => $item,
        ]);
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required|min:2|max:10',
            'price' => 'nullable|numeric|min:0',
        ]);

        Item::create([
            'name' => $request->name,
            'price' => $request->price,
        ]);
        return redirect('/buy-list')->with('success', 'Товар успешно добавлен');
    }
}
