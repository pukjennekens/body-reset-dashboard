<form wire:submit="saveService" class="space-y-4">
    <div class="grid grid-cols-2 gap-4">
        <x-input.date name="form.name" label="Naam" />
        <x-input.text name="form.appointment_duration_minutes" label="Duur afspraak (minuten)" />
        <x-input.text name="form.appointment_overlap_minutes" label="Overlap afspraak (minuten)" />
        <x-input.text name="form.price" label="Prijs" />
    </div>

    <x-input.button type="submit">Opslaan</x-input.button>
</form>