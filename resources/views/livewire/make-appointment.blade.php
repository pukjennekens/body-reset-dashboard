<div>
    <h2 class="text-2xl font-semibold mb-2">Afspraak maken</h2>

    <p>
        Je staat op het punt om een afspraak in te plannen voor:<br>
        <strong>{{ $service->name }}</strong> op <strong>{{ $date }}</strong> om <strong>{{ $from }}</strong>.<br>
        Weet je zeker dat je deze afspraak wilt maken? Je kunt de afspraak nog 24 uur van tevoren annuleren.
    </p>

    <p class="mt-4">
        <i class="fas fa-info-circle"></i> <strong>{{ $service->name }}</strong> kost {{ $service->price }} {{ $service->price == 1 ? 'credit' : 'credits' }}.
    </p>


    {{-- Check if the startDateTime is less then 24 hours from now, if so, show a warning --}}
    @if($startDateTime->lessThan(now()->addDay()))
        <p class="bg-yellow-100 rounded-lg border border-yellow-600 text-sm px-4 py-2 mt-2">
            <span class="mb-2"><i class="fas fa-exclamation-triangle"></i> <strong>Let op!</strong></span>
            <br>
            Deze afspraak valt binnen 24 uur. Je kunt afpsraken maximaal 24 uur van te voren annuleren. Dat betekent dat je deze afspraak niet meer kunt annuleren.
        </p>
    @endif

    @error('error')
        <p class="bg-red-200 rounded-lg border border-red-500 text-red-500 text-sm px-4 py-2 mt-2">{{ $message }}</p>
    @enderror

    <div>
        <hr class="my-4">
    </div>

    <div class="flex justify-end gap-2">
        <button wire:click="cancel" class="rounded-lg px-4 py-1.5 border-0 bg-red-500 text-sm text-white uppercase font-semibold hover:bg-red-700">Annuleren</button>
        <button wire:click="makeAppointment" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-sm text-white uppercase font-semibold hover:bg-green-600">Afspraak maken</button>
    </div>
</div>
