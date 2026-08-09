@extends("layouts.main")

@section("title", "Create Item")

@section("content")
    <form method="POST" action="{{route('buy-list.store')}}">
        <div class="app-fieldset">
            <div class="app-fieldset__title">Create Item</div>
            @csrf

            <div>
                <select
                        id="category_id"
                        name="category_id"
                        {{ old('is_self_cat') ? 'disabled' : null }}
                >
                    <option value="">— Без категории —</option>
                    @foreach($categories as $category)
                        <option
                                value="{{$category->id}}"
                                {{ $category->id == old('category_id') ? 'selected' : null }}
                        >
                            {{ $category->name }} {{ $category->user_id === Auth::id() ? " - self" : null }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label>
                    <input
                            id="is_self_cat"
                            type="checkbox"
                            name="is_self_cat"
                            {{ old('is_self_cat') ? 'checked' : null }}
                    />
                    Личная категория
                </label>
            </div>
            
            <x-form.input
                    id="self_cat"
                    name="self_cat"
                    :value="old('self_cat')"
                    :disabled="!old('is_self_cat')"
            >
            </x-form.input>
            
            <x-form.input
                    label="Name"
                    name="name"
                    :value="old('name')">
            </x-form.input>
            
            <x-form.input
                    label="Price"
                    name="price"
                    :value="old('price')">
            </x-form.input>
            
            <hr>
            <button class="app-btn" type="submit">Create</button>
        </div>
    </form>
    @include('partials.errors')
@endsection

@push('scripts')
    @vite('resources/js/cat_toggle.js')
@endpush
