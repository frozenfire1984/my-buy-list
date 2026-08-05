@extends("layouts.main")

@section("title", "Categories")

@section("content")
    <div class="layout-stack">

        <a class="app-btn" href="/categories/create">Create new category</a>

        @if(session('success'))
            <div>{{ session('success') }}</div>
        @endif

        <table class="app-table">
            <thead>
                <tr>
                    <th>is secret</th>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Actions</th>
                </tr>
            </thead>
            @foreach($categories as $category)
                <tr>
                    <td>
                        @if($category->is_secret)
                            *
                        @endif
                    </td>
                    <td>
                        <a href="/categories/{{$category->id}}/details">{{ $category->name }} </a>
                    </td>
                    <td>
                        {{ $category->description ?? "---" }}
                    </td>
                    <td>
                    @if($category->user_id === Auth::id() || auth()->user()?->is_super_admin)
                        <a class="app-btn" href="/categories/{{$category->id}}/edit">Edit</a>
                    @endif
                    </td>
                </tr>
            @endforeach
        </table>
    </div>
@endsection
