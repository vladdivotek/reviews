<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=yes, initial-scale=1.0, maximum-scale=5.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ trim($__env->yieldContent('title')) }}</title>
    <meta name="description" content="{{ trim($__env->yieldContent('description')) }}">
    <meta name="keywords" content="{{ trim($__env->yieldContent('keywords')) }}">
    <link rel="alternate" hreflang="{{ str_replace('_', '-', app()->getLocale()) }}">
    @vite('resources/scss/app.scss')
    @yield('styles')
</head>

<body>

    @include('include.header')

    <main class="main container">
        @yield('content')
    </main>

    @include('include.footer')

    @vite('resources/js/app.js')
    @yield('scripts')

</body>
</html>
