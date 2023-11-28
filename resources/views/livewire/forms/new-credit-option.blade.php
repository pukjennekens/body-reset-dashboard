<div>
    <form wire:submit="createCreditOption" class="space-y-4">

        <x-input.text name="form.name" label="Naam" />
        <x-input.text name="form.price" label="Prijs" />
        <x-input.text name="form.expiration_days" label="Aantal dagen geldig" />
        <x-input.text name="form.credits" label="Aantal credits" />
        <label for="form.is_active" class="mb-1 flex items-center justify-start gap-2">
            <input type="checkbox" wire:model.fill="form.is_active" @if(old('form.is_active', $creditOption ? $creditOption->is_active : false)) checked @endif>
            <span>Actief</span>
        </label>
        <x-input.text name="form.sort_order" label="Sorteer volgorde" />

        <x-input.button type="submit">Opslaan</x-input.button>
    </form>
</div>