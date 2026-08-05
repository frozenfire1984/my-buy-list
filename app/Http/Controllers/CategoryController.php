<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()?->is_super_admin) {
            $categories = Category::all();
        } else {
            $categories = Category::where('is_secret', false)->get();
        }

        return view('categories.index', [
            'categories' => $categories
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'min:2', 'max:50', Rule::unique('categories', 'name')],
            'description' => 'nullable',
        ]);

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'is_secret' => $request->boolean('is_secret'),
            'user_id' => auth()->id(),
        ]);

        if ($request->boolean('is_secret')) {
            return redirect('categories')->with('success', 'Секретная категория успешно добавлена');
        }

        return redirect('categories')->with('success', 'Категория успешно добавлена');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $category = Category::findOrFail($id);
        return view("categories.details", [
            'category' => $category
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $category = Category::findOrFail($id);

        Gate::authorize('update-secret-category', $category);

        return view('categories.edit', [
            'category' => $category
        ]);
    }

    /**
     * Update the specified resource in storage.кон
     */
    public function update(Request $request, string $id)
    {
        $category = Category::findOrFail($id);
        Gate::authorize('update-secret-category', $category);

        $validated = $request->validate([
            'name' => ['required', 'min:2', 'max:50', Rule::unique('categories', 'name')->ignore($id)],
            'description' => 'nullable',
            //'user_id' => 'nullable|exists:users,id',
        ]);

        $validated['is_secret'] = $request->boolean('is_secret');
        $category->update($validated);

        return redirect('categories')->with('success', 'Категория успешно обновлена');


    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $category = Category::findOrFail($id);

        $is_save_items = true; // further has been implemented 2 variants for user

        if ($is_save_items) {
            Item::where("category_id", $category->id)
                ->update([
                    "category_id" => null
                ]);
        } else {
            Item::where("category_id", $category->id)->delete();
        }

        $category->delete();
        return redirect('categories')->with('success', 'Категория успешно удалена');
    }
}
