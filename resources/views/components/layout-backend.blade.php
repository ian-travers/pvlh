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
    <flash data="{{ session('flash') }}"></flash>
    <main class="container-fluid">
        @section('breadcrumbs', Breadcrumbs::render())
        @yield('breadcrumbs')
        <div class="row">
            <div class="col-sm-2 col-12">
                <x-backend-left-sidebar></x-backend-left-sidebar>
            </div>
            <div class="col-sm-10 col-12">
                {{ $slot }}
            </div>
        </div>
    </main>
</div>
<script src="{{ mix('js/app.js', 'build') }}"></script>
</body>
</html>

