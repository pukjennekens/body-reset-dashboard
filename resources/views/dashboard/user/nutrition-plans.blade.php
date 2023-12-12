@php
    $imageUrl = 'https://images.unsplash.com/photo-1467453678174-768ec283a940?ixlib=rb-4.0.3&q=85&fm=jpg&crop=entropy&cs=srgb&w=640';
@endphp

<x-dashboard-layout>
    <div class="max-w-6xl mx-auto">
        <h2 class="text-2xl font-semibold mb-4">
            Uw voedingsschema's:
        </h2>

        @if(auth()->user()->nutritionPlans()->count() > 0)
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach(auth()->user()->nutritionPlans()->get() as $nutritionPlan)
                    <a
                        href="{{ route('dashboard.user.nutrition-plans.show', ['id' => $nutritionPlan->id]) }}"
                        style="background-image: linear-gradient(rgba(0,0,0,0.4), rgba(0,0,0,0.4)), url({{ $imageUrl }});"
                        class="aspect-video bg-cover bg-center rounded-lg shadow-md flex items-center justify-center text-white font-bold text-3xl"
                    >
                        {{ $nutritionPlan->date->format('d-m-Y') }}
                    </a>
                @endforeach
            </div>
        @else
            <p>
                U heeft nog geen voedingsschema's.
            </p>
        @endif
    </div>
</x-dashboard-layout>