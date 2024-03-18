<form class="bg-white shadow-md p-4 rounded-lg" wire:submit.prevent="save">
    <h3 class="text-xl font-semibold mb-4">
        Gegevens bijwerken
    </h3>

    <div class="grid grid-cols-2 gap-4 mb-4">
        <x-input.text name="form.name" label="Naam" />
        <x-input.text name="form.email" label="E-mailadres" />
        <x-input.text name="form.phone_number" label="Telefoonnummer" />
        <x-input.date name="form.birth_date" label="Geboortedatum" />

        <x-input.select name="form.language" label="Taal" value="{{ old('form.language', $user ? $user->language : '') }}">
            <option value="nl" {{ old('form.language', $user ? $user->language : '') == 'nl' ? 'selected' : '' }}>Nederlands</option>
            <option value="en" {{ old('form.language', $user ? $user->language : '') == 'en' ? 'selected' : '' }}>Engels</option>
            <option value="fr" {{ old('form.language', $user ? $user->language : '') == 'fr' ? 'selected' : '' }}>Frans</option>
        </x-input.select>
    </div>

    <x-input.button>
        Opslaan
    </x-input.button>
</form>
