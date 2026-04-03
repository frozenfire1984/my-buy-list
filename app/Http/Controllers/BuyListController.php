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
