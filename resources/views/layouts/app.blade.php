<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title') | {{ config('app.name', 'Laravel') }}</title>

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
    </style>

    <!-- Scripts -->
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/toastr.min.js') }}"></script>
    <script src="{{ asset('js/offcanvas.js') }}" defer></script>
    <script>
        function copyMyFriendCode(friendCode) {
            navigator.clipboard.writeText(friendCode)
            .then(function() {
                //alert(friendCode);
                toastr.success('コピーしました。');
            }, function(err) {
                toastr.error('コピーに失敗しました。');
            });
        }
    </script>
    <!-- Add Scripts -->
    @stack('remove')
    @stack('modal_validation')
    @stack('datepicker')
    @stack('tinymce')
    @stack('reset')
    @stack('delete')
</head>

<body>
    @if (Auth::check())
    @include('layouts.navbar')
    @endif
    <div class="container mt-3">
        <main>
        @yield('content')
        </main>
        <footer class="my-1 pt-4 text-muted text-center text-small">
            <p class="mb-1">&copy; 2017−2019 会社名</p>
            <ul class="list-inline">
                <li class="list-inline-item"><a href="#">プライバシー</a></li>
                <li class="list-inline-item"><a href="#">条項</a></li>
                <li class="list-inline-item"><a href="#">サポート</a></li>
            </ul>
        </footer>
    </div>
    @include('layouts.flash')
</body>
</html>