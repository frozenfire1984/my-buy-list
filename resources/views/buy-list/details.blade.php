@extends("layouts.app")

@section("title", "Details page")

@section("content")
    <a href="/buy-list">Back</a>
    <br><br>

    <article>
        <h2>{{ $item->name }}</h2>
        @if($item->price !== null)
            <p>price: {{ $item->price }}</p>
        @endif
        @if($item->category)
            <p>category: {{ $item->category->name }}</p>
        @endif
        <p>added: {{ $item->created_at->format('d.m.Y H:i') }}</p>

        <hr>

        <div class="app-btn-group">
            <a class="app-btn" href="/buy-list/{{$item->id}}/edit">Edit</a>
            <form method="POST" action="/buy-list/{{ $item->id }}">
                @csrf
                @method('DELETE')
                <button class="app-btn" type="submit">Delete</button>
            </form>
        </div>
    </article>
@endsection
