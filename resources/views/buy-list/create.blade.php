@extends("layouts.main")

@section("title", "Create Item")

@section("content")
    <form method="POST" action="/buy-list">
        <div class="app-fieldset">
            <div class="app-fieldset__title">Create Item</div>
            @csrf

            <div>
                <select name="category_id">
                    <option value="">— Без категории —</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}"> {{ $category->name }}</option>
                    @endforeach
                </select>
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
