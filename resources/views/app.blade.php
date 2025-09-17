<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name') }}</title>
    @routes
    @viteReactRefresh
    @vite([theme_path('css/app.css'), theme_path('js/app.jsx')])
    @inertiaHead
</head>
<body>
@inertia
</body>
</html>
