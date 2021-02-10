<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Comments</title>

    <link rel="stylesheet" href="{{ mix('css/app.css') }}" />
</head>
<body class="antialiased">
    <div>
        <div class="min-h-screen bg-gray-100">
            @include('layouts.partials._header')

            @yield('content')
        </div>
    </div>
    <script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
