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
                <select name="category_id">
                    <option value="">— Без категории —</option>
                    @foreach($categories as $category)
                        <option value="{{$category->id}}" {{ $item->category_id == $category->id ? 'selected' : '' }}> {{ $category->name }}</option>
                    @endforeach
                </select>
            </div>
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
            <div>
                <input class="app-input" type="text" name="name" value="{{ old('name', $item->name ?? '') }}">
                @error('name')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <div>
                <input class="app-input" type="text" name="price" value="{{ old('price', $item->price ?? '') }}">
                @error('price')
                <div style="color: red">{{ $message }}</div>
                @enderror
            </div>
            <hr>
            <button class="app-btn" type="submit">Update</button>
        </div>
    </form>

    @include('partials.errors')
@endsection
