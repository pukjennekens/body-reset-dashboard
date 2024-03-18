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

            @if($role == 'user')
                {{-- Birth date --}}
                <x-input.date name="form.birth_date" label="Geboortedatum" value="{{ old('form.birth_date', $user ? $user->birth_date : '') }}" :disabled="!$editing" />
            @endif

            {{-- Language --}}
            <x-input.select name="form.language" label="Taal" value="{{ old('form.language', $user ? $user->language : '') }}" :disabled="!$editing">
                <option value="nl" {{ old('form.language', $user ? $user->language : '') == 'nl' ? 'selected' : '' }}>Nederlands</option>
                <option value="en" {{ old('form.language', $user ? $user->language : '') == 'en' ? 'selected' : '' }}>Engels</option>
                <option value="fr" {{ old('form.language', $user ? $user->language : '') == 'fr' ? 'selected' : '' }}>Frans</option>
            </x-input.select>

            @if($role == 'user')
                {{-- Phone --}}
                <x-input.text name="form.phone_number" label="Telefoonnummer" value="{{ old('form.phone_number', $user ? $user->phone_number : '') }}" :disabled="!$editing" />
            @endif
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            @if($role == 'user')
                {{-- Street --}}
                <x-input.text name="form.street_name" label="Straat" value="{{ old('form.street_name', $user ? $user->street_name : '') }}" :disabled="!$editing" />

                {{-- House number --}}
                <x-input.text name="form.house_number" label="Huisnummer" value="{{ old('form.house_number', $user ? $user->house_number : '') }}" :disabled="!$editing" />

                {{-- Postal code --}}
                <x-input.text name="form.postal_code" label="Postcode" value="{{ old('form.postal_code', $user ? $user->postal_code : '') }}" :disabled="!$editing" />

                {{-- City --}}
                <x-input.text name="form.city" label="Stad" value="{{ old('form.city', $user ? $user->city : '') }}" :disabled="!$editing" />
            @endif

            {{-- Country --}}
            <x-input.select name="form.country" label="Land" :disabled="!$editing">
                <option value="nl" {{ old('form.country', $user ? $user->country : '') == 'nl' ? 'selected' : '' }}>Nederland</option>
                <option value="be" {{ old('form.country', $user ? $user->country : '') == 'be' ? 'selected' : '' }}>België</option>
            </x-input.select>

            @if($role == 'user')
                {{-- Province --}}
                <x-input.text name="form.province" label="Provincie" value="{{ old('form.province', $user ? $user->province : '') }}" :disabled="!$editing" />
            @endif
        </div>

        @if($role == 'user')
            <div>
                <h3 class="text-2xl font-semibold mt-12">
                    Credits:
                </h3>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                {{-- Credits --}}
                <x-input.text name="form.credits" label="Credits" value="{{ old('form.credits', $user ? $user->credits : '') }}" :disabled="!$editing" />

                {{-- Credits expiration date --}}
                <x-input.date name="form.credits_expiration_date" label="Credits vervaldatum" value="{{ old('form.credits_expiration_date', $user->credits_expiration_date ? $user->credits_expiration_date->format('Y-m-d') : '') }}" :disabled="!$editing" />
            </div>
        @endif

        <div>
            <h3 class="text-2xl font-semibold mt-12">
                Systeem:
            </h3>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
            <select class="rounded-lg px-4 py-1.5 w-full border border-gray-600 disabled:bg-gray-200" wire:model.change="role" label="Rol" {{ !$editing ? 'disabled' : '' }}>
                <option value="admin" {{ old('form.role', $role) == 'admin' ? 'selected' : '' }}>Admin</option>
                <option value="manager" {{ old('form.role', $role) == 'manager' ? 'selected' : '' }}>Manager</option>
                <option value="trainer" {{ old('form.role', $role) == 'trainer' ? 'selected' : '' }}>Trainer</option>
                <option value="user" {{ old('form.role', $role) == 'user' ? 'selected' : '' }}>Klant</option>
            </select>
        </div>

        <div>
            <h3 class="text-2xl font-semibold mt-12">
                Trainer:
            </h3>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-2">
                @if($role == 'user')
                    <x-input.select name="form.trainer_user_id" label="Trainer" :disabled="!$editing">
                        <option value="">Geen trainer</option>
                        @foreach($trainers as $trainer)
                            <option value="{{ $trainer->id }}" {{ old('form.trainer_user_id', $user ? $user->trainer_user_id : '') == $trainer->id ? 'selected' : '' }}>{{ $trainer->name }}</option>
                        @endforeach
                    </x-input.select>
                @endif

                <x-input.select name="form.branch_id" label="Vestiging" :disabled="!$editing">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}" {{ old('form.branch_id', $user ? $user->branch_id : '') == $branch->id ? 'selected' : '' }}>{{ $branch->name }}</option>
                    @endforeach
                </x-input.select>
            </div>
        </div>

        @if($role == 'manager' && auth()->user()->hasRole('admin'))
            <div>
                <h3 class="text-2xl font-semibold mt-12 mb-2">
                    Manager-specifieke instellingen:
                </h3>

                <div class="flex flex-col">
                    {{-- manager_branches --}}
                    @foreach($branches as $branch)
                        <label for="manager_branches" class="inline-flex items-center gap-2">
                            <input type="checkbox" wire:model.fill="form.manager_branches" value="{{ $branch->id }}" {{ in_array($branch->id, old('form.manager_branches', $user ? $user->manager_branches : []) ?: []) ? 'checked' : '' }} {{ !$editing ? 'disabled' : '' }} class="rounded-lg border border-gray-600 disabled:bg-gray-200 checked:bg-blue-600 checked:border-transparent">
                            {{ $branch->name }}
                        </label>
                    @endforeach
                </div>

                @error('form.manager_branches') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror 
            </div>
        @endif

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