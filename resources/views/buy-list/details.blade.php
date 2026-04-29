@extends("layouts.main")

@section("title", "Details page")

@section("content")
    <a href="{{route('buy-list.index')}}">Back</a>
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
        @auth
        <div class="app-btn-group">
            <a class="app-btn" href="{{ route('buy-list.edit', ['id' => $item->id]) }}">Edit</a>
            <form method="POST" action="{{ route('buy-list.destroy', ['id' => $item->id]) }}">
                @csrf
                @method('DELETE')
                <button class="app-btn" type="submit">Delete</button>
            </form>
        </div>
        @endauth
    </article>
@endsection
