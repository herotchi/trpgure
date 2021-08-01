<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <!-- metaタグ -->
    @include('layouts.meta')

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/android-chrome-192x192.png') }}">

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    @include('layouts.ga')
</head>

<body>
    <main class="container mt-5">
        @yield('content')
    </main>
</body>
</html>