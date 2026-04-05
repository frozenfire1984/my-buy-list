@extends("layouts.app")

@section("title", "Create Item")

@section("content")
    <form method="POST" action="/buy-list-create">
        <div class="app-fieldset">
            <div class="app-fieldset__title">Create Item</div>
            @csrf
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
