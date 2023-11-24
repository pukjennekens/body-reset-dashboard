<div>
    <div class="mb-2 flex items-center justify-between">
        <h3 class="text-2xl font-semibold">
            Persoonsgegevens:
        </h3>

        @if(!$editing)
            <x-input.button wire:click="toggleEditing">
                <i class="fas fa-edit"></i>
            </x-input.button>
        @endif
    </div>

    <form wire:submit="updatePersonalInfo" class="space-y-4">
        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            {{-- Name --}}
            <x-input.text name="form.name" label="Naam" value="{{ old('form.name', $user ? $user->name : '') }}" :disabled="!$editing" />

            {{-- Email --}}
            <x-input.text name="form.email" label="E-mailadres" value="{{ old('form.email', $user ? $user->email : '') }}" :disabled="!$editing" />

            {{-- Birth date --}}
            <x-input.date name="form.birth_date" label="Geboortedatum" value="{{ old('form.birth_date', $user ? $user->birth_date : '') }}" :disabled="!$editing" />

            {{-- Language --}}
            <x-input.select name="form.language" label="Taal" value="{{ old('form.language', $user ? $user->language : '') }}" :disabled="!$editing">
                <option value="nl" {{ old('form.language', $user ? $user->language : '') == 'nl' ? 'selected' : '' }}>Nederlands</option>
                <option value="en" {{ old('form.language', $user ? $user->language : '') == 'en' ? 'selected' : '' }}>Engels</option>
                <option value="fr" {{ old('form.language', $user ? $user->language : '') == 'fr' ? 'selected' : '' }}>Frans</option>
            </x-input.select>

            {{-- Phone --}}
            <x-input.text name="form.phone_number" label="Telefoonnummer" value="{{ old('form.phone_number', $user ? $user->phone_number : '') }}" :disabled="!$editing" />

        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            {{-- Street --}}
            <x-input.text name="form.street_name" label="Straat" value="{{ old('form.street_name', $user ? $user->street_name : '') }}" :disabled="!$editing" />

            {{-- House number --}}
            <x-input.text name="form.house_number" label="Huisnummer" value="{{ old('form.house_number', $user ? $user->house_number : '') }}" :disabled="!$editing" />

            {{-- Postal code --}}
            <x-input.text name="form.postal_code" label="Postcode" value="{{ old('form.postal_code', $user ? $user->postal_code : '') }}" :disabled="!$editing" />

            {{-- City --}}
            <x-input.text name="form.city" label="Stad" value="{{ old('form.city', $user ? $user->city : '') }}" :disabled="!$editing" />

            {{-- Country --}}
            <x-input.select name="form.country" label="Land" :disabled="!$editing">
                <option value="nl" {{ old('form.country', $user ? $user->country : '') == 'nl' ? 'selected' : '' }}>Nederland</option>
                <option value="be" {{ old('form.country', $user ? $user->country : '') == 'be' ? 'selected' : '' }}>België</option>
            </x-input.select>

            {{-- Province --}}
            <x-input.text name="form.province" label="Provincie" value="{{ old('form.province', $user ? $user->province : '') }}" :disabled="!$editing" />
        </div>

        @if($editing)
            <div class="inline-flex items-center gap-4">
                <x-input.button type="submit">
                    Opslaan
                </x-input.button>

                <button type="button" class="text-red-400 underline" wire:click="cancelEditing">
                    Annuleren
                </button>
            </div>
        @endif
    </form>
</div>