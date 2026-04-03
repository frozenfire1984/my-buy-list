@extends("layouts.app")

@section("title")
    <h1>List of items</h1>
@endsection

@section("content")
    <p>Count of items {{ $count }}</p>
    <ul>
        @foreach($items as $item)
            <li><a href="/buy-list-details/{{$item->id}}">{{ $item->name }}</a></li>
        @endforeach
    </ul>

    <hr>
    <form method="POST" action="/buy-list">
        @csrf
        <div>
            <input type="text" name="name" value="{{ old('name') }}">
            @error('name')
            <div style="color: red">{{ $message }}</div>
            @enderror
        </div>
        <div>
            <input type="text" name="price" value="{{ old('price') }}">
            @error('price')
            <div style="color: red">{{ $message }}</div>
            @enderror
        </div>
        <hr>
        <button type="submit">Create</button>
    </form>
    @include('partials.flash')
@endsection
