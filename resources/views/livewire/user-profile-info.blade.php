<div class="flex gap-4 mb-4">
    <div>
        @php
            $nameParts = explode(' ', $user->name);
            $firstName = $nameParts[0];
            $lastName = end($nameParts);
            $firstLetterFirstName = substr($firstName, 0, 1);
            $firstLetterLastName = substr($lastName, 0, 1);
        @endphp
        
        <div class="rounded-full bg-primary text-white font-bold w-12 h-12 inline-flex items-center justify-center">
            {{ $firstLetterFirstName }}{{ $firstLetterLastName }}
        </div>
    </div>

    <div>
        <h2 class="text-2xl font-semibold mb-1">
            {{ $user->name }}
        </h2>

        <p class="text-sm mb-2">
            {{ Carbon\Carbon::parse($user->birth_date)->age }} jaar
        </p>

        <p class="text-sm">
            <strong>Gewicht:</strong> {{ $user->getWeight() ? $user->getWeight() . ' kg' : 'Nog niet gemeten' }}
            <br>
            <strong>Lengte:</strong> {{ $user->getLength() ? $user->getLength() . ' cm' : 'Nog niet gemeten' }}
        </p>
    </div>
</div>
