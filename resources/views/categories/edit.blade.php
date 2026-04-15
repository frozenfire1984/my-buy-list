@extends("layouts.main")

@section("title", "Edit Category")

@section("content")
    <form method="POST" action="/categories/{{ $category->id }}">
        @method('PUT')
        <div class="app-fieldset">
            <div class="app-fieldset__title">Edit Category</div>
            @csrf
            <div>
                <input class="app-input" type="text" name="name" value="{{ old('name', $category->name ?? '') }}">
                @error('name')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <input class="app-input" type="text" name="description" value="{{ old('description', $category->description ?? '') }}">
                @error('description')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <hr>
            <button class="app-btn" type="submit">Update</button>
        </div>
    </form>

    @include('partials.errors')
@endsection
