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
    <div class="min-h-screen flex justify-center items-center" style="background-image: linear-gradient( rgba(255, 255, 255, 0.2), rgba(255, 255, 255, 0.2) ), url({{@asset('img/auth-background.jpg')}}">
        <div class="bg-white rounded-sm p-8 shadow-lg mx-4 max-w-md">
            {{ $slot }}
        </div>
    </div>

    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>