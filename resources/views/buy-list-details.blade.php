<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Details') }}</title>

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
            <h1>Details page</h1>

            <a href="/buy-list">Back</a>
            <br><br>

            <article>
                <h2>{{ $item->name }}</h2>
                @if($item->price !== null)
                    <p>price: {{ $item->price }}</p>
                @endif
                <p>added: {{ $item->created_at->format('d.m.Y H:i') }}</p>
            </article>
        </main>

        <footer>
            <hr>
            copyright
        </footer>
    </body>
</html>
