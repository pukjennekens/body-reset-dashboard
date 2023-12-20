<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ env('APP_NAME') }} - Dashboard</title>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/js/all.min.js"></script>

    <link rel="shortcut icon" href="{{ asset('favicon.png') }}" type="image/x-icon">

    @vite('resources/css/app.css')
    @livewireStyles
</head>
<body class="bg-white">
    <nav class="bg-white w-full py-4 px-8 flex items-center justify-between">
        <div class="flex items-center gap-4" x-data="{ mobileMenuOpen: false }">
            <button class="w-8 h-8 border border-gray-300 rounded-md block md:hidden" @click="mobileMenuOpen = !mobileMenuOpen">
                <i class="fas fa-bars"></i>
            </button>

            <div
                x-show="mobileMenuOpen"
                class="fixed inset-0 z-50 bg-white block md:hidden"
                x-on:keydown.escape.window="mobileMenuOpen = false"
                x-transition:enter="transition ease-in-out duration-500 transform"
                x-transition:enter-start="-translate-x-full"
                x-transition:enter-end="translate-x-0"
                x-transition:leave="transition ease-in-out duration-500 transform"
                x-transition:leave-start="translate-x-0"
                x-transition:leave-end="-translate-x-full"
            >
                <div class="p-4 flex justify-start">
                    <button class="text-2xl p-2" @click="mobileMenuOpen = false">
                        <i class="fas fa-times"></i>
                    </button>
                </div>

                <div class="flex flex-col">
                    @if(auth()->user()->hasRole(['user']))
                        <a class="uppercase w-full px-4 py-2 hover:bg-gray-100" href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-simple"></i> Prestaties</a>

                        <a class="uppercase w-full px-4 py-2 hover:bg-gray-100" href="{{ route('dashboard.user.nutrition-plans') }}"><i class="fa-solid fa-utensils"></i> Voedingsschema's</a>

                        <a class="uppercase w-full px-4 py-2 hover:bg-gray-100" href="{{ route('dashboard.user.appointments') }}"><i class="fa-solid fa-calendar-days"></i> Afspraken</a>
                    @endif

                    @if(auth()->user()->hasRole(['admin', 'manager', 'trainer']))
                        <a class="uppercase w-full px-4 py-2 hover:bg-gray-100" href="{{ route('dashboard.admin.home') }}"><i class="fa-solid fa-list"></i> Overzicht</a>

                        <a class="uppercase w-full px-4 py-2 hover:bg-gray-100" href="{{ route('dashboard.admin.users.index') }}"><i class="fas fa-users"></i> Gebruikers</a>

                        <a class="uppercase w-full px-4 py-2 hover:bg-gray-100" href="{{ route('dashboard.admin.recipies.index') }}"><i class="fas fa-utensils"></i> Recepten</a>
                    @endif

                    @if(auth()->user()->hasRole(['admin']))
                        <x-dropdown align="left" width="48">
                            <x-slot name="trigger">
                                <button type="button" class="uppercase w-full px-4 py-2 hover:bg-gray-100 text-left" href="{{ route('dashboard.admin.recipies.index') }}"><i class="fas fa-cog"></i> Beheer</button>
                            </x-slot>

                            <x-slot name="content">
                                <x-dropdown-link :href="route('dashboard.admin.settings.credits')">
                                    {{ __('Credits instellingen') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('dashboard.admin.settings.credit-orders')">
                                    {{ __('Bestellingen') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('dashboard.admin.settings.branches')">
                                    {{ __('Filialen') }}
                                </x-dropdown-link>

                                <x-dropdown-link :href="route('dashboard.admin.settings.services')">
                                    {{ __('Diensten') }}
                                </x-dropdown-link>
                            </x-slot>
                        </x-dropdown>
                    @endif
                </div>
            </div>

            <a href="{{ route('dashboard') }}">
                <img src="{{ asset('img/logo.svg') }}" alt="{{ env('APP_NAME') }}" class="w-28">
            </a>
        </div>

        <div class="flex items-center gap-8">
            @if(auth()->user()->hasRole('user'))
                @livewire('nav-credits-overview')
            @endif

            <x-dropdown align="right" width="48">
                <x-slot name="trigger">
                    <div class="rounded-full w-12 h-12 bg-primary uppercase text-white inline-flex items-center justify-center font-bold cursor-pointer">
                        @php
                            $nameParts = explode(' ', auth()->user()->name);
                            $firstName = $nameParts[0];
                            $lastName = end($nameParts);
                            $firstLetterFirstName = substr($firstName, 0, 1);
                            $firstLetterLastName = substr($lastName, 0, 1);
                        @endphp

                        {{ $firstLetterFirstName }}{{ $firstLetterLastName }}
                    </div>
                </x-slot>

                <x-slot name="content">
                    <x-dropdown-link :href="route('dashboard')">
                        {{ __('Test link') }}
                    </x-dropdown-link>

                    <x-dropdown-link :href="route('dashboard')">
                        {{ __('Test link') }}
                    </x-dropdown-link>

                    <hr class="my-2">

                    <x-dropdown-link :href="route('dashboard')">
                        <form action="{{ route('auth.logout') }}" method="POST">
                            @csrf

                            <button type="submit" class="w-full text-left">
                                {{ __('Log out') }}
                            </button>
                        </form>
                    </x-dropdown-link>
                </x-slot>
            </x-dropdown>
        </div>
    </nav>

    <hr>

    <header class="w-full px-8 bg-primary text-white hidden md:flex">
        <div class="flex w-full justify-center">
            @if(auth()->user()->hasRole(['user']))
                <a class="uppercase text-sm py-5 px-6 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-simple"></i> Prestaties</a>

                <a class="uppercase text-sm py-5 px-6 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard.user.nutrition-plans') }}"><i class="fa-solid fa-utensils"></i> Voedingsschema's</a>

                <a class="uppercase text-sm py-5 px-6 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard.user.appointments') }}"><i class="fa-solid fa-calendar-days"></i> Afspraken</a>
            @endif

            @if(auth()->user()->hasRole(['admin', 'manager', 'trainer']))
                <a class="uppercase text-sm py-5 px-6 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard.admin.home') }}"><i class="fa-solid fa-list"></i> Overzicht</a>

                <a class="uppercase text-sm py-5 px-6 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard.admin.users.index') }}"><i class="fas fa-users"></i> Gebruikers</a>

                <a class="uppercase text-sm py-5 px-6 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard.admin.recipies.index') }}"><i class="fas fa-utensils"></i> Recepten</a>
            @endif

            @if(auth()->user()->hasRole(['admin', 'manager']))
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button type="button" class="uppercase text-sm py-5 px-6 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard.admin.recipies.index') }}"><i class="fas fa-cog"></i> Beheer</button>
                    </x-slot>

                    <x-slot name="content">
                        @if(auth()->user()->hasRole('admin'))
                            <x-dropdown-link :href="route('dashboard.admin.settings.credits')">
                                {{ __('Credits instellingen') }}
                            </x-dropdown-link>

                            <x-dropdown-link :href="route('dashboard.admin.settings.credit-orders')">
                                {{ __('Bestellingen') }}
                            </x-dropdown-link>
                        @endif

                        <x-dropdown-link :href="route('dashboard.admin.settings.branches')">
                            {{ __('Filialen') }}
                        </x-dropdown-link>

                        @if(auth()->user()->hasRole('admin'))
                            <x-dropdown-link :href="route('dashboard.admin.settings.services')">
                                {{ __('Diensten') }}
                            </x-dropdown-link>
                        @endif
                    </x-slot>
                </x-dropdown>
            @endif
        </div>
    </header>

    <main class="p-8 max-w-full">
        {{ $slot }}
    </main>

    @livewireScripts
    @vite('resources/js/app.js')
    @livewire('wire-elements-modal')

    <script>
        (function(d, t, g, k) {
            var ph = d.createElement(t),
            s = d.getElementsByTagName(t)[0],
            t = (new URLSearchParams(window.location.search)).get(k);
            t && localStorage.setItem(k, t);
            t = localStorage.getItem(k);
            ph.type = 'text/javascript';
            ph.async = true;
            ph.defer = true;
            ph.charset = 'UTF-8';
            ph.src = g + '&v=' + (new Date()).getTime();
            ph.src += t ? '&' + k + '=' + t : '';
            s.parentNode.insertBefore(ph, s);
        })(document, 'script', '//feedback.devsatwork.eu/?p=11534&ph_apikey=c2a10319ed8ba58a023102a1e4541dc2', 'ph_access_token');
    </script>
</body>
</html>