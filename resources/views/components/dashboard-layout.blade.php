<!DOCTYPE html>
<html lang="en">
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
<body class="bg-gray-50">
    <nav class="bg-white w-full py-4 px-8 flex items-center justify-between">
        <a href="{{ route('dashboard') }}">
            <img src="{{ asset('img/logo.svg') }}" alt="{{ env('APP_NAME') }}" class="w-28">
        </a>

        <div class="flex items-center gap-8">
            @if(auth()->user()->hasRole('user'))
                <div class="flex items-center gap-6">
                    @if(auth()->user()->credits > 0)
                        <x-dropdown align="center" width="48">
                            <x-slot name="trigger">
                                <p class="underline decoration-dotted cursor-pointer">U heeft <strong>{{ auth()->user()->credits }}</strong> credits</p>
                            </x-slot>

                            <x-slot name="content">
                                <p class="px-4 py-2 text-center">Uw credits verlopen op {{ auth()->user()->credits_expiration_date->format('d-m-Y') }}</p>
                            </x-slot>
                        </x-dropdown>
                    @else
                        <p>U heeft geen credits</p>
                    @endif

                    <button 
                        class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600 text-center" 
                        x-data=""
                        x-on:click.prevent="$dispatch('openModal', {component: 'buy-credits'})"
                    >
                        Credits kopen
                    </button>
                </div>
            @endif

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

    <header class="w-full px-8 flex bg-primary text-white">
        <div class="flex">
            @if(auth()->user()->hasRole(['user']))
                <a class="uppercase text-sm py-2 px-4 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard') }}"><i class="fa-solid fa-chart-simple"></i> Prestaties</a>

                <a class="uppercase text-sm py-2 px-4 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard.user.nutrition-plans') }}"><i class="fa-solid fa-utensils"></i> Voedingsschema's</a>
            @endif

            @if(auth()->user()->hasRole(['admin', 'manager', 'trainer']))
                <a class="uppercase text-sm py-2 px-4 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard.admin.users.index') }}"><i class="fas fa-users"></i> Gebruikers</a>
            @endif

            @if(auth()->user()->hasRole(['admin', 'manager', 'trainer']))
                <a class="uppercase text-sm py-2 px-4 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard.admin.recipies.index') }}"><i class="fas fa-utensils"></i> Recepten</a>
            @endif

            @if(auth()->user()->hasRole(['admin']))
                <x-dropdown align="left" width="48">
                    <x-slot name="trigger">
                        <button type="button" class="uppercase text-sm py-2 px-4 hover:bg-green-600 inline-flex items-center gap-2" href="{{ route('dashboard.admin.recipies.index') }}"><i class="fas fa-cog"></i> Beheer</button>
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
    </header>

    <main class="p-8 max-w-full">
        {{ $slot }}
    </main>

    @livewireScripts
    @vite('resources/js/app.js')
    @livewire('wire-elements-modal')
</body>
</html>