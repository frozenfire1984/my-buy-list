<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rule;
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
    public function index(Request $request) {

        //dump(auth()->user()->is_super_admin);

        $sort = $request->query('sort', 'id');
        $direction = $request->query('direction', 'asc');


        if (!in_array($sort, ['name', 'price', 'category'])) $sort = 'id';
        if (!in_array($direction, ['asc', 'desc'])) $direction = 'asc';


        if (auth()->user()?->is_super_admin) {
            $message = "Hello " . auth()->user()->name . " . You are God!";
            $items = Item::with('category', 'user')->get();
            $items->each(function($item) {
                if ($item->user_id === null) {
                    $item->is_free = true;
                };

                if ($item->user_id === auth()->user()->id) {
                    $item->is_admin_item = true;
                }
            });
            //dd($items->toArray());
        } else {
            $message = "Hello guest";
            $items = Item::with('category')->whereNull('user_id')->get();
            $items->each(function($item) {
                $item->is_free = true;
            });

            if (auth()->check()) {
                //$user_items = Item::with('category')->where('user_id', auth()->id())->get();
                $user_items = Item::with('category')
                    ->where('user_id', auth()->id())
                    ->where(fn($q) => $q->whereNull('category_id')
                        ->orWhereHas('category', fn($q) => $q->where('is_secret', false)))
                    ->get();
                /* need replace by Scope on model */
                $items = $user_items->merge($items);
                $message = "Hello " . auth()->user()->name;
            }
        }

        $sortField = $sort === 'category' ? 'category.name' : $sort;
        $items = $items->sortBy($sortField, SORT_REGULAR, $direction === 'desc');

        $count = $items->count();
        return view('buy-list.index', compact('items', 'count', 'message', 'sort', 'direction'));

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

        /*dd([
            'auth_id' => auth()->id(),
            'auth_email' => auth()->user()->email,
            'is_super_admin' => auth()->user()->is_super_admin,
            'item_id' => $item->id,
            'item_user_id' => $item->user_id,
            'gate_allows' => Gate::allows('view-item', $item),
        ]);*/


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
        if (auth()->user()?->is_super_admin) {
            $categories = Category::all();
        } else {
            $categories = Category::where('is_secret', false)->get();
        }
        return view('buy-list.create', [
            'categories' => $categories,
        ]);
    }

    public function store (Request $request) {


        $categoryRule = auth()->user()->is_super_admin
            ? 'nullable|exists:categories,id'
            : ['nullable', Rule::exists('categories', 'id')->where('is_secret', 0)];

        $request->validate([
            'name' => 'required|min:2|max:50',
            'price' => 'nullable|numeric|min:0',
            'category_id' => $categoryRule,
            //'category_id' => 'nullable|exists:categories,id'
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
        $users = [];

        if (auth()->user()?->is_super_admin) {
            $users = User::all();
        }

        if (Gate::denies('update-item', $item)) {
            return redirect()->route('buy-list.claim', $id)->with('success', 'Подтвердите если хотите присвоить этот товар себе');
        }

        if (auth()->user()?->is_super_admin) {
            $categories = Category::all();
        } else {
            $categories = Category::where('is_secret', false)->get();
        }
        return view('buy-list.edit', compact('item', 'categories', 'users'));
    }

    public function update (Request $request, $id) {

        /*dd(
            $request->category_id,                                          // что улетает из формы
            \App\Models\Category::find($request->category_id)?->is_secret,  // секретная ли она
            auth()->user()->is_super_admin                                  // а ты сейчас супер-админ?
        );*/


        $categoryRule = auth()->user()->is_super_admin
            ? 'nullable|exists:categories,id'
            : ['nullable', Rule::exists('categories', 'id')->where('is_secret', 0)];

        $validated = $request->validate([
            'name' => 'required|min:2|max:50',
            'price' => 'nullable|numeric|min:0',
            'category_id' => $categoryRule,
            'user_id' => 'nullable|exists:users,id',
        ]);

        $item = Item::findOrFail($id);


        Gate::authorize('update-item', $item);
        $item->update($validated);
        return redirect()->route('buy-list.index')->with('success', 'Товар успешно обновлен');
    }

    public function claim($id) {
        $item = Item::findOrFail($id);

        if ($item->user_id !== null) {
            return redirect()->route('buy-list.index')->with('error', 'Вы пытались присвоить чужой товар');
        }

        return view('buy-list.claim', [
            'item' => $item,
        ]);
    }

    public function claim_confirm($id) {
        $item = Item::findOrFail($id);

        if ($item->user_id !== null) {
            return redirect()->route('buy-list.index')->with('error', 'Этот товар уже кто-то присвоил');
        }

        $item->user_id = auth()->id();
        $item->save();
        return redirect()->route('buy-list.edit', $id)->with('success', 'Товар успешно присвоен, теперь можите редактировать его');
    }

    public function destroy (Request $request, $id) {
        $item = Item::findOrFail($id);
        Gate::authorize('update-item', $item);
        $item->delete();

        return redirect()->route('buy-list.index')->with('success', 'Товар успешно удален');
    }
}
