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
            'count' => $count
        ]);
    }
}
