<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <script src="{{ asset('js/app.js') }}" defer="defer"></script>
    </head>
    <body class="font-body bg-zinc-800">
        <div id="app">
            <top-page></top-page>
        </div>
    </body>
</html>
