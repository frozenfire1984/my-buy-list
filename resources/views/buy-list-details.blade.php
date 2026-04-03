@extends("layouts.app")

@section("title")
    <h1>Details page</h1>
@endsection

@section("content")
    <a href="/buy-list">Back</a>
    <br><br>

    <article>
        <h2>{{ $item->name }}</h2>
        @if($item->price !== null)
            <p>price: {{ $item->price }}</p>
        @endif
        <p>added: {{ $item->created_at->format('d.m.Y H:i') }}</p>
    </article>
@endsection
