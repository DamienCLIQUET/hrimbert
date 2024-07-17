<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name=" robots" content="noindex, nofollow">
        @vite(['resources/css/app.css', 'resources/js/app.js'])
        <title>@yield('title') | Administration</title>
        <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>
        <link rel="icon" href="../../../images/Logo.png"/>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.css" rel="stylesheet">
        <script src="https://unpkg.com/htmx.org@1.8.6"></script>
        <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>
        <script defer src="https://cdn.jsdelivr.net/npm/@alpinejs@3.x.x/dist/alpine.min.js"></script>
        @livewireStyles
    </head>
    <body class="body">
        <div class="corps">
            <div class="header">
                @yield('content')
            </div>
        </div>
        @livewireScripts
    </body>
</html>