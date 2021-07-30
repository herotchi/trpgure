<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="shortcut icon" href="{{ asset('img/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('img/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/android-chrome-192x192.png') }}">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'TRPGURE') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('css/toastr.min.css') }}" rel="stylesheet">
    <!-- Custom styles -->
    <link href="{{ asset('css/offcanvas.css') }}" rel="stylesheet">
    @stack('login')
    @stack('add_user')
    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
        .carousel-control-next,
        .carousel-control-prev {
            padding: 0;
            background: none;
            border: 0;
        }
    </style>
    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    @if (Auth::check())
    <script src="{{ asset('js/offcanvas.js') }}" defer></script>
    @endif
    <script>
        function copyMyFriendCode(friendCode) {
            navigator.clipboard.writeText(friendCode)
            .then(function() {
                toastr.success('コピーしました。');
            }, function(err) {
                toastr.error('コピーに失敗しました。');
            });
        }
    </script>
    <!-- Add Scripts -->
    @stack('remove')
    @stack('datepicker')
    @stack('delete')
</head>

<body>
    @if (Auth::check())
    @include('layouts.navbar')
    @endif
    <div class="container @if (Auth::check())mt-3 @endif">
        <main>
            @yield('content')
        </main>
        @if (Auth::check())
        <footer class="my-1 pt-4 text-muted text-center text-small">
            <p class="mb-1">&copy; 2020−2021 へろっちシマウマ～ず</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="{{ route('terms_of_use') }}" target="_blank"
                        rel="noopener noreferrer">利用規約@include('layouts.blank')</a></li>
                <li class="list-inline-item"><a href="{{ route('privacy_policy') }}" target="_blank"
                        rel="noopener noreferrer">プライバシー@include('layouts.blank')</a></li>
                <li class="list-inline-item"><u class="text-primary" data-bs-toggle="modal"
                        data-bs-target="#howToUseModal">使い方</u></li>
            </ul>
        </footer>
        @endif
    </div>
    @include('layouts.flash')
    @include('layouts.how_to_use')
</body>
</html>