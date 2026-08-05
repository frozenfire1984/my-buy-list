@extends("layouts.main")

@section("title", "Details page")

@section("content")
    <a href="/categories">Back</a>
    <br><br>

    <article>
        <h2>{{ $category->name }}</h2>
        @if($category->description)
            {{ $category->description }}
        @endif
        <p>added: {{ $category->created_at->format('d.m.Y H:i') }}</p>

        @if($category->is_secret)
            *Секретная
        @endif

        <hr>

        @if($category->user_id === Auth::id() || auth()->user()?->is_super_admin)
            <div class="app-btn-group">
                <a class="app-btn" href="/categories/{{$category->id}}/edit">Edit</a>
                <form method="POST" action="/categories/{{ $category->id }}">
                    @csrf
                    @method('DELETE')
                    <button class="app-btn" type="submit">Delete</button>
                </form>
            </div>
        @endif
    </article>
@endsection
