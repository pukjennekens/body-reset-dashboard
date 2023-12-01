<form action="" wire:submit="createBranch" class="space-y-4">
    <div class="grid grid-cols-2 gap-4">
        <x-input.text name="form.name" label="Naam" value="{{ old('form.name', $branch ? $branch->name : '') }}" />
        <x-input.text name="form.phone_number" label="Telefoonnummer" value="{{ old('form.phone_number', $branch ? $branch->phone_number : '') }}" />
        <x-input.text name="form.street_name" label="Straatnaam" value="{{ old('form.street_name', $branch ? $branch->street_name : '') }}" />
        <x-input.text name="form.house_number" label="Huisnummer" value="{{ old('form.house_number', $branch ? $branch->house_number : '') }}" />
        <x-input.text name="form.postal_code" label="Postcode" value="{{ old('form.postal_code', $branch ? $branch->postal_code : '') }}" />
        <x-input.text name="form.city" label="Stad" value="{{ old('form.city', $branch ? $branch->city : '') }}" />
        <x-input.select name="form.country" label="Land">
            <option value="nl" {{ old('form.country', $branch ? $branch->country : '') == 'nl' ? 'selected' : '' }}>Nederland</option>
            <option value="be" {{ old('form.country', $branch ? $branch->country : '') == 'be' ? 'selected' : '' }}>België</option>
        </x-input.select>
        <x-input.text name="form.province" label="Provincie" value="{{ old('form.province', $branch ? $branch->province : '') }}" />
    </div>

    <x-input.button type="submit">Opslaan</x-input.button>
</form>