@extends("layouts.main")

@section("title", "Main Page")

@section("content")
    <section>
        <div>
            <x-top-items
                    label="топ товаров"
                    :count="7"
                    :is-hh="true" />
            <hr>

            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, consequatur distinctio doloribus incidunt magni neque nostrum praesentium reprehenderit rerum veniam.</p>
            <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, odio?</p>
        </div>
    </section>
@endsection
