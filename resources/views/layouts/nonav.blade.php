<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="@yield('keywords')eetree,电子森林">
    <meta name="description" content="@yield('description')">

    <title>@yield('title') - {{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    @yield('beforeScripts')
    <script src="{{ mix('js/pages/manifest.js') }}"></script>
    <script src="{{ mix('js/pages/vendor.js') }}"></script>
    <script src="{{ mix('js/app.js') }}"></script>
    @yield('scripts')
</body>
</html>
