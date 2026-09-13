@extends("layouts.main")
@use("App\Utils\Sorting")

@section("title", "List of items")

@php
    $table_link_class = 'app-table__sort-link';
    $is_debug = request()->has('debug');
@endphp

@section("content")
    <div class="layout-stack">
        
        @if($message ?? false)
            <div><em><b>{{ $message }}</b></em></div>
        @endif
        
        <p>Count of items {{ $count }}</p>
        
        @if($items->count())
            @can('create-item')
                <a class="app-btn" href="{{ route('buy-list.create') }}">Create new item</a>
            @endcan
        @endif
        
        @if(session('error'))
            <div style="color: red;">{{ session('error') }}</div>
        @endif
        
        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif
        
        @if($items->count())
            
            @if ($is_debug)
                <pre>
                    $sort: {{ $sort }}
                    $direction: {{ $direction }}
                </pre>
            @endif
            
            <table class="app-table">
                <thead>
                <tr>
                    <th>
                        <x-ui.sort-link
                            text="ID of item"
                            route="buy-list.index"
                            sort-by="id"
                            :sort="$sort"
                            :direction="$direction"
                            :class="$table_link_class"
                            :is-debug="$is_debug"
                        />
                    </th>
                    <th>
                        <x-ui.sort-link
                            route="buy-list.index"
                            sort-by="name"
                            :sort="$sort"
                            :direction="$direction"
                            :class="$table_link_class"
                            :is-debug="$is_debug"
                        >
                            <x-slot:icon>
                                @svg('heroicon-s-cube')
                            </x-slot:icon>
                        </x-ui.sort-link>
                    </th>
                    <th>
                        <x-ui.sort-link
                            route="buy-list.index"
                            sort-by="price"
                            :sort="$sort"
                            :direction="$direction"
                            :class="$table_link_class"
                            :is-debug="$is_debug"
                        >
                            <x-slot:icon>
                                @svg('heroicon-s-currency-dollar')
                            </x-slot:icon>
                        </x-ui.sort-link>
                    </th>
                    <th>
                        <x-ui.sort-link
                            route="buy-list.index"
                            sort-by="category"
                            :sort="$sort"
                            :direction="$direction"
                            :class="$table_link_class"
                            :is-debug="$is_debug"
                        >
                            <x-slot:icon>
                                @svg('heroicon-s-folder')
                            </x-slot:icon>
                        </x-ui.sort-link>
                    </th>
                    <th>
                        {{--<a href="{{ route('buy-list.index', [
                            'sort' => 'status',
                            'direction' => $sort === 'status' && $direction === 'asc' ? 'desc' : 'asc' ]) }}">
                            Status {{ $sort === 'status' ? ($direction === 'asc' ? '↑' : '↓') : '↑↓' }}
                        </a>--}}
                        Status
                    </th>
                    <th></th>
                    @if(auth()->user()?->is_super_admin)
                        <th>User</th>
                    @endif
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
                            
                            @if ($item->is_admin_item)
                                <em style="color: red;">admin item!</em>
                            @endif
                        </td>
                        <td>
                            <div class="app-actions">
                                <a
                                    class="app-btn"
                                    href="{{ route('buy-list.edit', ['id' => $item->id]) }}">
                                    @svg('heroicon-o-pencil-square')
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('buy-list.destroy', ['id' => $item->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="app-btn" type="submit">
                                        @svg('heroicon-o-archive-box-x-mark')
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                        
                        @if(auth()->user()?->is_super_admin)
                            @php
                                $colspan = 7;
                            @endphp
                            <td>
                                @if (!$item->is_free)
                                    <span class="app-user">
                                        @svg('heroicon-s-user')
                                        {{ $item->user?->name }}
                                    </span>
                                @endif
                            </td>
                        @endif
                    </tr>
                    @if ($is_debug)
                    <tr>
                        <td colspan="{{ $colspan ?? 6 }}">
                            <details>
                                <summary><code><small>debug info</small></code></summary>
                                @dump($item->toArray())
                            </details>
                        </td>
                    </tr>
                    @endif
                @endforeach
                </tbody>
            </table>
        @else
            <p>Нет ни одного твоара</p>
            <a class="app-btn" href="{{ route('buy-list.create') }}">Create new item</a>
        @endif
        
        {{--<a href="/buy-list/7000/details">Broken item</a>--}}
    
    </div>
@endsection
