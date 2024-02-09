<div>
    <form wire:submit="createGirthMeasurement" class="space-y-4">

        <div class="grid grid-cols-2 gap-4">
            <x-input.date name="form.date" label="Datum" />
            <x-input.text name="form.upper_arm" label="Biceps" />
            <x-input.text name="form.chest" label="Borst" />
            <x-input.text name="form.under_breast" label="Onder borst" />
            <x-input.text name="form.waist" label="Taille" />
            <x-input.text name="form.hips" label="Heup" />
            <x-input.text name="form.thigh" label="Dij" />
        </div>

        <x-input.button type="submit">Opslaan</x-input.button>
    </form>
</div>

