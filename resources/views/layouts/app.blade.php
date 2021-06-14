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

    <!-- Custom styles -->
    @if (Auth::check())
    <link href="{{ asset('css/offcanvas.css') }}" rel="stylesheet">
    @else
    <link href="{{ asset('css/signin.css') }}" rel="stylesheet">
    @endif

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }
    </style>

    <!-- Add Scripts -->
    @stack('datepicker')
    @stack('tinymce')
    @stack('reset')
    @stack('delete')
    {{-- 
        @stack('user_policy')
        @stack('scenario_join')
        @stack('character_status')
    --}}

    {{--<script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>--}}
    {{--<script src="{{ asset('js/jquery.validate.min.js') }}" defer></script>--}}

</head>
@if (Auth::check())
<body>
    @include('layouts.navbar')
    <main class="container">
        {{--@if (session('flash_message'))
            <div class="flash_message d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
                <div class="lh-1">
                    <h1 class="h6 mb-0 text-white lh-1">{{ session('flash_message') }}</h1>
                </div>
            </div>
        @endif  --}}
        <div class="flash_message d-flex align-items-center p-3 my-3 text-white bg-purple rounded shadow-sm">
            <div class="lh-1">
                <h1 class="h6 mb-0 text-white lh-1">{{ session('flash_message') }}とっとこハム太郎が完了しました</h1>
            </div>
        </div>
        @yield('content')
    </main>
    <!-- Scripts -->
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/offcanvas.js') }}"></script>
</body>

@else
<body class="text-center">
    <main class="form-signin">
        @yield('content')
    </main>
</body>
@endif
</html>
