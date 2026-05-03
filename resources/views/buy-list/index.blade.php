@extends("layouts.main")

@section("title", "List of items")

@section("content")
    <div class="layout-stack">

        @if($message ?? false)
            <div><em><b>{{ $message }}</b></em></div>
        @endif

        <p>Count of items {{ $count }}</p>

        @can('create-item')
            <a class="app-btn" href="{{ route('buy-list.create') }}">Create new item</a>
        @endcan

        @if(session('error'))
            <div style="color: red;">{{ session('error') }}</div>
        @endif

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <ol class="app-list">
            @foreach($items as $item)
                <li>
                    <div>
                    <b><a href="{{ route('buy-list.show', ['id' => $item->id]) }}">{{ $item->name }}</a></b><br>
                        cat: <em>{{ $item->category?->name ?? "--без категории--" }}</em>
                        @if ($item->is_free)
                            <div><em style="color: green;">free</em></div>
                        @endif
                    </div>
                    <a class="app-btn" href="{{ route('buy-list.edit', ['id' => $item->id]) }}">Edit</a>
                </li>
            @endforeach
        </ol>


        <a href="/buy-list/7000/details">Broken item</a>

    </div>
@endsection
