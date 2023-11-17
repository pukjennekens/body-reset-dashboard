<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }}</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-gray-100">
    <nav class="bg-white w-full py-4 px-8 flex items-center justify-between">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('img/logo.svg') }}" alt="{{ env('APP_NAME') }}" class="w-28">
        </a>

        <div class="flex items-center gap-8">
            <div class="flex items-center gap-6">
                <p>U heeft <strong>10</strong> credits</p>
                <a href="#" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600" x-data="" x-on:click.prevent="$dispatch('open-modal', 'buy-credits')">
                    Credits kopen
                </a>

                <x-modal name="buy-credits" :show="true" focusable>
                    <x-slot name="title">
                        Credits kopen
                    </x-slot>

                    In dit menu kun je in de toekomst credits kopen
                </x-modal>
            </div>

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <div class="rounded-full w-12 h-12 bg-primary uppercase text-white inline-flex items-center justify-center font-bold cursor-pointer">
                        PJ
                    </div>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('dashboard')">
                        {{ __('Test link') }}
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
    </nav>

    <hr>

    <header class="w-full px-8 flex bg-primary text-white">
        <div class="flex">
            <a class="uppercase text-sm py-2 px-4 hover:bg-green-600 inline-flex items-center gap-2" href="#"><i class="fa-solid fa-chart-simple"></i> Prestaties</a>
            <a class="uppercase text-sm py-2 px-4 hover:bg-green-600 inline-flex items-center gap-2" href="#"><i class="fa-regular fa-calendar"></i> Afspraken</a>
            <a class="uppercase text-sm py-2 px-4 hover:bg-green-600 inline-flex items-center gap-2" href="#"><i class="fa-solid fa-utensils"></i> Voedingsschema's</a>
            <a class="uppercase text-sm py-2 px-4 hover:bg-green-600 inline-flex items-center gap-2" href="#"><i class="fa-solid fa-folder"></i> Documenten</a>
        </div>
    </header>

    <main class="p-8 max-w-full">
        {{ $slot }}
    </main>

    @livewireScripts
    @vite('resources/js/app.js')
</body>
</html>