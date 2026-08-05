@extends("layouts.main")

@section("title", "Create Item")

@section("content")
    <form method="POST" action="{{route('buy-list.store')}}">
        <div class="app-fieldset">
            <div class="app-fieldset__title">Create Item</div>
            @csrf

            <div>
                <select id="category_id" name="category_id">
                    <option value="">— Без категории —</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"> {{ $category->name }}   {{ $category->user_id === Auth::id() ? " - self" : null }}</option>
                    @endforeach
                </select>
            </div>

            <div>
                <label><input id="is_self_cat" type="checkbox" name="is_self_cat" />Личная категория</label>
            </div>

            <div>
                <input disabled id="self_cat" class="app-input" type="text" name="self_cat"  value="{{ old('self_cat') }}">
            </div>

            <div>
                <input class="app-input" type="text" name="name" value="{{ old('name') }}">
                @error('name')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <input class="app-input" type="text" name="price" value="{{ old('price') }}">
                @error('price')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <hr>
            <button class="app-btn" type="submit">Create</button>
        </div>
    </form>
    @include('partials.errors')
@endsection

@push('scripts')
    @vite('resources/js/cat_toggle.js')
@endpush
