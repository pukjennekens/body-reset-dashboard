<div>
    <form wire:submit="createBodyCompositionMeasurement" class="space-y-4">

        <div class="grid grid-cols-2 gap-4">
            <x-input.date name="form.date" label="Datum" />
            <x-input.text name="form.height" label="Lengte" />
            <x-input.text name="form.weight" label="Gewicht" />
            <x-input.text name="form.bone_mass" label="Botmassa" />
            <x-input.text name="form.muscle_mass" label="Spiermassa" />
            <x-input.text name="form.fat_percentage" label="Vet percentage" />
            <x-input.text name="form.water_percentage" label="Water percentage" />
            <x-input.text name="form.metabolic_age" label="Metabolische leeftijd" />
            <x-input.text name="form.visceral_fat" label="Visceraal vet" />
        </div>

        <x-input.button type="submit">Opslaan</x-input.button>
    </form>
</div>
