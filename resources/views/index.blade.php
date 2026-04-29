@extends("layouts.main")

@section("title", "Main Page")

@section("content")
    <section>
        <div>
            <ul>
            @foreach($top_items as $item)
                <li>
                    <a href="{{route('buy-list.show', ['id' => $item->id])}}">{{ $item->name }}</a>
                </li>
            @endforeach
            </ul>

            <br>
            <br>
            <br>
            <br>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, consequatur distinctio doloribus incidunt magni neque nostrum praesentium reprehenderit rerum veniam.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, odio?</p>
        </div>
    </section>
@endsection
