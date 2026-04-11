@extends("layouts.app")

@section("title", "Categories")

@section("content")
    <div class="layout-stack">

        <a class="app-btn" href="/categories/create">Create new category</a>

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <ol class="app-list">
            @foreach($categories as $category)
                <li>
                    <a href="/categories/{{$category->id}}/details">{{ $category->name }} </a>
                    <a class="app-btn" href="/categories/{{$category->id}}/edit">Edit</a>
                </li>
            @endforeach
        </ol>
    </div>
@endsection
