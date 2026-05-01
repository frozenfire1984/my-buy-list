<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Item;
use App\Models\User;
use Illuminate\Auth\Access\AuthorizationException;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Gate;


class BuyListController extends Controller
{
    public function index() {
        $message = "Hello guest";

        if (auth()->check()) {
            $items = Item::with('category')->where('user_id', auth()->id())->get();
            $user_name = auth()->user()->name;
            $message = "Hello " . $user_name;
        } else {
            $items = Item::with('category')->where('user_id', null)->get();
        }

        $count = $items->count();
        return view('buy-list.index', compact('items', 'count', 'message'));

        /*try {
            $items = Item::with('category')->where('user_id', auth()->id())->get();
            $count = $items->count();
            return view('buy-list.index', compact('items', 'count'));
        } catch(Exception $e) {
            Log::error('Не удалось загрузить товары: ' . $e->getMessage());
            throw $e;
        } finally {
            Log::info('index() выполнен');
        }*/

        //$items = Item::all();
        /*$items = Item::with('category')->get();
        $count = $items->count();
        return view('buy-list.index', [
            'items' => $items,
            'count' => $count,
            'meta' => [
                'title' => "Items page",
                'description' => "Lorem ipsum dolor sit amet",
                'keywords' => "Lorem, ipsum, dolor, sit, amet",
            ],
        ]);*/
    }

    public function show($id) {

        $item = Item::findOrFail($id);
        Gate::authorize('view-item', $item);
        return view('buy-list.details', [
            'item' => $item,
        ]);

        /*try {
            $item = Item::findOrFail($id);
            Gate::authorize('view-item', $item);
            return view('buy-list.details', [
                'item' => $item,
            ]);
        } catch(AuthorizationException $e) {
            Log::error('Нет доступа: ' . $e->getMessage());
            return redirect()->route('buy-list.index')->with('error', 'Нет доступа');
        } catch(Exception $e) {
            Log::error('Не удалось загрузить детальный вид: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Не удалось загрузить детальный вид');
        } finally {
            Log::info('show() выполнен');
        }*/
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
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
        ]);
        //return redirect('/buy-list')->with('success', 'Товар успешно добавлен');
        return redirect()->route('buy-list.index')->with('success', 'Товар успешно добавлен');
    }

    public function edit($id) {

        $item = Item::findOrFail($id);
        Gate::authorize('update-item', $item);
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


        Gate::authorize('update-item', $item);
        $item->update($validated);
        return redirect()->route('buy-list.index')->with('success', 'Товар успешно обновлен');
    }

    public function destroy (Request $request, $id) {
        $item = Item::findOrFail($id);
        Gate::authorize('update-item', $item);
        $item->delete();

        return redirect()->route('buy-list.index')->with('success', 'Товар успешно удален');

    }
}
