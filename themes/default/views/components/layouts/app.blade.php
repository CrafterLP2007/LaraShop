<!DOCTYPE html>
<html
    lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>{{ config("app.name")  }} | {{ $title ?? '' }}</title>

    @vite(['themes/default/css/app.css', 'themes/default/js/app.js'], 'default')
    @livewireStyles
    @livewireScripts
</head>
<body class="antialiased flex flex-col min-h-screen">
    {{ $slot }}
</body>
</html>
