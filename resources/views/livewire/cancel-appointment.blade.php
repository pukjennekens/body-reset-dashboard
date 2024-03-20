<div class="space-y-2">
    <h2 class="text-2xl font-semibold">Weet je zeker dat je deze afspraak wilt annuleren?</h2>

    <p>
        Deze afspraak kostte je <strong>{{ $appointment->service->price }} {{ $appointment->service->price == 1 ? 'credit' : 'credits' }}</strong>, deze credit(s) worden teruggezet op je account.
    </p>

    <div>
        <hr class="my-4">
    </div>

    <div class="flex justify-end gap-2">
        <button wire:click="cancel" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-sm text-white uppercase font-semibold hover:bg-green-600">Niet annuleren</button>
        <button 
            wire:click="cancelAppointment"
            class="rounded-lg px-4 py-1.5 border-0 bg-red-500 text-sm text-white uppercase font-semibold hover:bg-red-700"
            wire:loading.attr="disabled"
            wire:target="cancelAppointment"
        >
            <span>Annuleren</span>
            <span wire:loading wire:target="cancelAppointment" class="ml-2"><i class="fas fa-spinner fa-spin"></i></span>
        </button>
    </div>
</div>
