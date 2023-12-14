<div>
    <h2 class="text-2xl font-semibold mb-2">Afspraak maken</h2>

    <p>
        U staat op het punt om een afspraak in te plannen voor:<br>
        <strong>{{ $service->name }}</strong> op <strong>{{ $date }}</strong> om <strong>{{ $from }}</strong>.<br>
        Weet u zeker dat u deze afspraak wilt maken? U kunt de afspraak nog 24 uur van tevoren annuleren.
    </p>

    <p class="mt-4">
        <i class="fas fa-info-circle"></i> <strong>{{ $service->name }}</strong> kost {{ $service->price }} {{ $service->price == 1 ? 'credit' : 'credits' }}.
    </p>

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
