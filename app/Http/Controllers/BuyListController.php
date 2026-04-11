<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;

class BuyListController extends Controller
{
    public function index() {
        $items = Item::all();
        $count = $items->count();
        return view('buy-list.index', [
            'items' => $items,
            'count' => $count,
            'meta' => [
                'title' => "Items page",
                'description' => "Lorem ipsum dolor sit amet",
                'keywords' => "Lorem, ipsum, dolor, sit, amet",
            ],
        ]);
    }

    public function show($id) {
        $item = Item::findOrFail($id);
        return view('buy-list.details', [
            'item' => $item,
        ]);
    }

    public function create () {

        $categories = Category::all();
        return view('buy-list.create', [
            'categories' => $categories,
        ]);
    }

    public function store (Request $request) {
        $request->validate([
            'name' => 'required|min:2|max:50',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Item::create([
            'name' => $request->name,
            'price' => $request->price,
            'category_id' => $request->category_id,
        ]);
        return redirect('/buy-list')->with('success', 'Товар успешно добавлен');
    }

    public function edit($id) {
        $item = Item::findOrFail($id);
        $categories = Category::all();

        return view('buy-list.edit', [
            'item' => $item,
            'categories' => $categories,
        ]);
    }

    public function update (Request $request, $id) {
        $validated = $request->validate([
            'name' => 'required|min:2|max:50',
            'price' => 'nullable|numeric|min:0',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        $item = Item::findOrFail($id);

        $item->update($validated);

        return redirect('/buy-list')->with('success', 'Товар успешно обновлен');
    }

    public function destroy (Request $request, $id) {
        $item = Item::findOrFail($id);

        $item->delete();

        return redirect('/buy-list')->with('success', 'Товар успешно удален');

    }
}
