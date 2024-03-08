@props(['user'])

<x-dashboard-layout>
    <a href="{{ route('dashboard.admin.users.index') }}" class="text-sm inline-flex items-center gap-2 border-b border-b-primary text-primary mb-4 hover:text-green-600 hover:border-b-green-600">
        <i class="fa-solid fa-chevron-left"></i>
        Terug
    </a>

    <div class="grid grid-cols-1 lg:grid-cols-12 gap-8">
        <div class="col-span-1 lg:col-span-3">
            <div class="hidden lg:block">
                @livewire('user-profile-info', ['id' => $user->id])
            </div>

            <h2 class="block lg:hidden text-2xl font-semibold mb-2">
                Gebruiker: {{ $user->name }}
            </h2>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-1 gap-2">
                <a href="{{ route('dashboard.admin.users.show', ['id' => $user->id]) }}" class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 inline-flex items-center gap-2 {{ request()->routeIs('dashboard.admin.users.show') ? 'border-primary' : '' }}">
                    <i class="fa-solid fa-address-card"></i>
                    {{ $user->hasRole('user') ? 'Dossier' : 'Gegevens' }}
                </a>

                @if($user->hasRole('user'))
                    <a href="{{ route('dashboard.admin.users.anamnesis', ['id' => $user->id]) }}" class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 inline-flex items-center gap-2 {{ request()->routeIs('dashboard.admin.users.anamnesis') ? 'border-primary' : '' }}">
                        <i class="fa-solid fa-kit-medical"></i>
                        Anamnese
                    </a>

                    <a href="{{ route('dashboard.admin.users.measurements', ['id' => $user->id]) }}" class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 inline-flex items-center gap-2 {{ request()->routeIs('dashboard.admin.users.measurements') ? 'border-primary' : '' }}"">
                        <i class="fa-solid fa-ruler"></i>
                        Metingen
                    </a>

                    <a href="{{ route('dashboard.admin.users.nutrition-plans', ['id' => $user->id]) }}" class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 inline-flex items-center gap-2 {{ request()->routeIs('dashboard.admin.users.nutrition-plans') ? 'border-primary' : '' }}"">
                        <i class="fa-solid fa-utensils"></i>
                        Voedingsschema's
                    </a>

                    <a href="{{ route('dashboard.admin.users.appointments', ['id' => $user->id]) }}" class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 inline-flex items-center gap-2 {{ request()->routeIs('dashboard.admin.users.appointments') ? 'border-primary' : '' }}"">
                        <i class="fa-solid fa-calendar"></i>
                        Afspraken
                    </a>
                @endif
            </div>
        </div>

        <div class="col-span-1 lg:col-span-9">
            @yield('content')
        </div>
    </div>
</x-dashboard-layout>