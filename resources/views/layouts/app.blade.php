<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name') }} {{ $meta['title'] ?? '' }}</title>
        <meta name="description" content="{{ $meta['description'] ?? '' }}">
        <meta name="keywords" content="{{ $meta['keywords'] ?? '' }}">

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/css/scss/index.scss', 'resources/js/app.js'])
    </head>
    <body>
        <header>
            <div class="container">
                <nav class="app-nav">
                    <ul>
                        @if(!request()->is('/'))
                            <li><a href="/">Home</a></li>
                        @endif
                        <li><a href="/buy-list">Buy List</a></li>
                        <li><a href="/about">About Us</a></li>
                        <li><a href="/contacts">Contacts</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <main>
            <div class="container">
                @hasSection("title")
                    <h1 class="app-title mb-4">@yield("title")</h1>
                @endif
                @yield("content")
            </div>
        </main>

        <footer>
            <div class="container">
                copyright
            </div>
        </footer>
    </body>
</html>
