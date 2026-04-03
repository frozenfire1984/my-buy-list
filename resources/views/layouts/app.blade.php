<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} {{ $meta['title'] ?? '' }}</title>
        <meta name="description" content="{{ $meta['description'] ?? '' }}">
        <meta name="keywords" content="{{ $meta['keywords'] ?? '' }}">

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header>
            <nav>
                <ul>
                    @if(!request()->is('/'))
                        <li><a href="/">Home</a></li>
                    @endif
                    <li><a href="/buy-list">Buy List</a></li>
                    <li><a href="/about">About Us</a></li>
                    <li><a href="/contacts">Contacts</a></li>
                </ul>
            </nav>
        </header>

        <main>
            @yield("title")
            <hr>
            @yield("content")
        </main>

        <footer>
            <hr>
            copyright
        </footer>
    </body>
</html>
