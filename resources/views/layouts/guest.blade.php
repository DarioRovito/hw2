<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('site.name', 'Laravel') }} @yield('title')</title>

    <link rel='stylesheet' href='{{ asset('css/signup.css') }}'>
    @yield('script')
    
    </head>
<body>
<main class="login">
<section class="section_main">
     @yield('content')
        </section>

    </main>
</body>


<footer>
    <p>
        Developed by Dario Rovito
    </p>
</footer>

</html>


