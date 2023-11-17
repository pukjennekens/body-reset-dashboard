<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body>
    <nav class="w-full bg-primary">
        <ul>
            <li>
                <a href="#">Prestaties</a>
            </li>
        </ul>
    </nav>

    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>