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
<body class="bg-gray-100 min-h-screen flex justify-center items-center">

    <div class="bg-white p-8 rounded shadow-sm w-full mx-4 max-w-md">
        <div class="text-center mb-8">
            <img src="{{ asset('img/logo.svg') }}" alt="{{ env('APP_NAME') }}" class="w-32 mx-auto">
        </div>

        {{ $slot }}
    </div>

    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>