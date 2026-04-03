<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <nav>
            <ul>
                <li><a href="/buy-list">Buy List</a></li>
                <li><a href="/about">About Us</a></li>
            </ul>
        </nav>

        <main>
            <h1>List of items</h1>

            <p>Count of items {{ $count }}</p>
            <ul>
                @foreach($items as $item)
                    <li><a href="/buy-list-details/{{$item->id}}">{{ $item->name }}</a></li>
                @endforeach
            </ul>


            <hr>
            <form method="POST" action="/buy-list">
                @csrf
                <div>
                    <input type="text" name="name" value="{{ old('name') }}">
                    @error('name')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <input type="text" name="price" value="{{ old('price') }}">
                    @error('price')
                    <div style="color: red">{{ $message }}</div>
                    @enderror
                </div>
                <hr>
                <button type="submit">Create</button>
            </form>
            @if(session('success'))
                <div>{{ session('success') }}</div>
            @endif

            @if($errors->any())
                <ul>
                    @foreach($errors->all() as $error)
                        <li style="color: red;">{{ $error }}</li>
                    @endforeach
                </ul>
            @endif
        </main>

        <footer>
            <hr>
            copyright
        </footer>
    </body>
</html>
