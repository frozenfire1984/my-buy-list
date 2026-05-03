@extends("layouts.main")

@section("title", "Claim Item")

@section("content")
    <form method="POST" action="{{ route('buy-list.claim', ['id' => $item->id]) }}">
        @method('PUT')
        @csrf
        @if(session('success'))
            <div class="text-center">{{ session('success') }}</div>
            <hr>
        @endif

        <p class="text-center mb-4">Вы точно хотите добавить себе товар {{ $item->name }}?</p>
        <hr>
        <div class="flex justify-center mt-4">
            <button class="app-btn" type="submit">Claim</button>
        </div>
    </form>

    @include('partials.errors')
@endsection
