@extends("layouts.main")

@section("title", "List of items")

@section("content")
    <div class="layout-stack">

        <p>Count of items {{ $count }}</p>
        <a class="app-btn" href="/buy-list/create">Create new item</a>

        @if(session('error'))
            <div>{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <ol class="app-list">
            @foreach($items as $item)
                <li>
                    <div>
                    <b><a href="/buy-list/{{$item->id}}/details">{{ $item->name }}</a></b><br>
                        cat: <em>{{ $item->category?->name ?? "--без категории--" }}</em>
                    </div>
                    <a class="app-btn" href="/buy-list/{{$item->id}}/edit">Edit</a>
                </li>
            @endforeach
        </ol>


        <a href="/buy-list/7000/details">Broken item</a>

    </div>
@endsection
