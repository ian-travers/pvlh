<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link href="{{ mix('css/app.css', 'build') }}" rel="stylesheet">
</head>
<body class="login-page">
<div id="app">
    <main class="py-4">
        <div class="text-center mb-5">
            <h2 class="text-primary my-3">ИС "План выдачи локомотивов на хозяйственные работы"</h2>
        </div>
        {{ $slot }}
    </main>
</div>
<script src="{{ mix('js/app.js', 'build') }}" defer></script>
</body>
</html>
