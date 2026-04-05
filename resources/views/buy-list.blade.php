@extends("layouts.app")

@section("title", "List of items")

@section("content")
    <div class="layout-stack">

        <p>Count of items {{ $count }}</p>
        <a class="app-btn" href="/buy-list-create">Create new item</a>

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <ol class="app-list">
            @foreach($items as $item)
                <li>
                    <a href="/buy-list-details/{{$item->id}}">{{ $item->name }}</a>
                    <a class="app-btn" href="/buy-list-edit/{{$item->id}}">Edit</a>
                </li>
            @endforeach
        </ol>

    </div>
@endsection
