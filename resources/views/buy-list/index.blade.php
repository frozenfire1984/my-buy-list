@extends("layouts.main")
@use("App\Utils\Sorting")

@section("title", "List of items")

@php
    $table_link_class = 'app-table__sort-link';
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
            
            <pre>
                $sort: {{ $sort }}
                $direction: {{ $direction }}
            </pre>
            
           
            
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
                            :is-debug="true"
                        />
                    </th>
                    <th>
                        <x-ui.sort-link
                            route="buy-list.index"
                            sort-by="name"
                            :sort="$sort"
                            :direction="$direction"
                            :class="$table_link_class"
                            :is-debug="true"
                        >
                            <x-slot:icon>
                                <x-heroicon-s-cube />
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
                            :is-debug="true"
                        >
                            <x-slot:icon>
                                <x-heroicon-s-currency-dollar />
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
                            :is-debug="true"
                        >
                            <x-slot:icon>
                                <x-heroicon-s-folder />
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
                                    <x-heroicon-o-pencil-square />
                                    Edit
                                </a>
                                <form method="POST" action="{{ route('buy-list.destroy', ['id' => $item->id]) }}">
                                    @csrf
                                    @method('DELETE')
                                    <button class="app-btn" type="submit">
                                        <x-heroicon-o-archive-box-x-mark />
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                        @if(auth()->user()?->is_super_admin)
                            <td>
                                {{ $item->user?->name }}
                            </td>
                        @endif
                    </tr>
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
