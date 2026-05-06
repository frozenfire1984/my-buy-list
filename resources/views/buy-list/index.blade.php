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

        <table class="app-table">

            <thead class="app-table">
                <tr>
                    <th>Id</th>
                    <th>
                        <a href="{{ route('buy-list.index', [
                            'sort' => 'name',
                            'direction' => $sort === 'name' && $direction === 'asc' ? 'desc' : 'asc'
                            ]) }}">
                            Name {{ $sort === 'name' ? ($direction === 'asc' ? '↑' : '↓') : '' }}
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('buy-list.index', [
                            'sort' => 'price',
                            'direction' => $sort === 'price' && $direction === 'asc' ? 'desc' : 'asc' ]) }}">
                            Price {{ $sort === 'price' ? ($direction === 'asc' ? '↑' : '↓') : '' }}
                        </a>
                    </th>
                    <th>
                        <a href="{{ route('buy-list.index', [
                            'sort' => 'category',
                            'direction' => $sort === 'category' && $direction === 'asc' ? 'desc' : 'asc' ]) }}">
                            Category {{ $sort === 'category' ? ($direction === 'asc' ? '↑' : '↓') : '' }}
                        </a></th>
                    <th>Status</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach($items as $item)
                <tr>
                    <td>{{ $item->id }}</td>
                    <td><a href="{{ route('buy-list.show', ['id' => $item->id]) }}">{{ $item->name }}</a></td>
                    <td>{{ $item->price }}</td>
                    <td>{{ $item->category?->name ?? "--без категории--" }}</td>
                    <td>
                        @if ($item->is_free)
                            <em style="color: green;">free</em>
                        @endif
                    </td>
                    <td>
                        <div class="app-actions">
                            <a class="app-btn" href="{{ route('buy-list.edit', ['id' => $item->id]) }}">Edit</a>
                            <a class="app-btn" href="{{ route('buy-list.destroy', ['id' => $item->id]) }}">Delete</a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


        {{--<a href="/buy-list/7000/details">Broken item</a>--}}

    </div>
@endsection
