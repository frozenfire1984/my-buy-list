<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ config('app.name', 'Main page') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" />
    </head>
    <body class="bg-[#FDFDFC] dark:bg-[#0a0a0a] text-[#1b1b18] flex p-6 lg:p-8 items-center lg:justify-center min-h-screen flex-col">
        <header>
            <nav>
                <ul>
                    <li><a href="/buy-list">Buy List</a></li>
                    <li><a href="/about">About Us</a></li>
                </ul>
            </nav>
        </header>

        <main>
            <section>
                <h1>Main Page</h1>
                <div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, consequatur distinctio doloribus incidunt magni neque nostrum praesentium reprehenderit rerum veniam.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Accusantium, odio?</p>
                </div>
            </section>
        </main>

        <footer>
            <hr>
            copyright
        </footer>
    </body>
</html>
