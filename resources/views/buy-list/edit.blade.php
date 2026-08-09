@extends("layouts.main")

@section("title", "Edit Item")

@section("content")
    <form method="POST" action="{{ route('buy-list.update', ['id' => $item->id]) }}">
        @method('PUT')
        <div class="app-fieldset">
            <div class="app-fieldset__title">Edit Item</div>

            @if(session('success'))
                <div>{{ session('success') }}</div>
            @endif

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
                                value="{{$category->id}}" {{ $item->category_id == $category->id ? 'selected' : '' }}
                                {{ $category->id == old('category_id') ? 'selected' : null }}
                        >
                            {{ $category->name }}
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
                    disabled
                    name="self_cat"
                    :value="old('self_cat')"
                    :disabled="!old('is_self_cat')"
            >
            </x-form.input>
            
            @if (auth()->user()->is_super_admin)
                <div>
                    <select name="user_id">
                        <option value="">— Ничейный —</option>
                        @foreach($users as $user)
                            <option value="{{$user->id}}" {{ $user->id == $item->user_id ? 'selected' : '' }}> {{ $user->name }}</option>
                        @endforeach
                    </select>
                </div>
            @endif
            
            <x-form.input
                    label="Name"
                    name="name"
                    :value="old('name', $item->name ?? '')">
            </x-form.input>
            
            <x-form.input
                    label="Price"
                    name="price"
                    :value="old('price', $item->price ?? '')">
            </x-form.input>
            
            <hr>
            <button class="app-btn" type="submit">Update</button>
        </div>
    </form>

    @include('partials.errors')
@endsection

@push('scripts')
    @vite('resources/js/cat_toggle.js')
@endpush
