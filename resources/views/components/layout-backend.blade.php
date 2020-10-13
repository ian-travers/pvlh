<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title }}</title>
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body class="login-page">
<div id="app">
    <x-top-nav></x-top-nav>
    <main class="container-fluid">
        @section('breadcrumbs', Breadcrumbs::render())
        @yield('breadcrumbs')
        <div class="row">
            <div class="col-2">
                <x-backend-left-sidebar></x-backend-left-sidebar>
            </div>
            <div class="col-10">
                {{ $slot }}
            </div>
        </div>
    </main>
</div>
<script src="{{ mix('js/app.js', 'build') }}"></script>
@yield('script')
</body>
</html>

