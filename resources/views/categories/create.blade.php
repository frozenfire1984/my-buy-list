@extends("layouts.app")

@section("title", "Create Category")

@section("content")
    <form method="POST" action="/categories">
        <div class="app-fieldset">
            <div class="app-fieldset__title">Create Category</div>
            @csrf
            <div>
                <input class="app-input" type="text" name="name" value="{{ old('name') }}">
                @error('name')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <input class="app-input" type="text" name="description" value="{{ old('description') }}">
                @error('description')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <hr>
            <button class="app-btn" type="submit">Create</button>
        </div>
    </form>
    @include('partials.errors')
@endsection
