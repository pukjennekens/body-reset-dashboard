@props(['user'])

<x-dashboard-layout>
    <div class="grid grid-cols-12 gap-8">
        <div class="col-span-3">
            <h2 class="text-2xl font-semibold mb-4">
                {{ $user->name }}
            </h2>

            <div class="flex flex-col gap-2">
                <a href="{{ route('dashboard.admin.users.show', ['id' => $user->id]) }}" class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 inline-flex items-center gap-2 {{ request()->routeIs('dashboard.admin.users.show') ? 'border-primary' : '' }}">
                    <i class="fas fa-user"></i>
                    Persoonsgegevens
                </a>

                <a href="{{ route('dashboard.admin.users.measurements', ['id' => $user->id]) }}" class="px-4 py-2 rounded-md border border-gray-300 hover:bg-gray-100 inline-flex items-center gap-2 {{ request()->routeIs('dashboard.admin.users.measurements') ? 'border-primary' : '' }}"">
                    <i class="fa-solid fa-ruler"></i>
                    Metingen
                </a>
            </div>
        </div>

        <div class="col-span-9">
            @yield('content')
        </div>
    </div>
</x-dashboard-layout>