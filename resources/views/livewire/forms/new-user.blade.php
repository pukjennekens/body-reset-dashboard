<form action="" wire:submit="createUser" class="space-y-8">
    @if(auth()->user()->hasRole('admin'))
        <div>
            <h2 class="text-2xl font-semibold mb-2">Systeem</h2>
            
            <div class="grid grid-cols-2 gap-4">
                <select class="rounded-lg px-4 py-1.5 w-full border border-gray-600 disabled:bg-gray-200" wire:model.change="role" label="Rol">
                    <option value="admin" {{ old('form.role', $role) == 'admin' ? 'selected' : '' }}>Admin</option>
                    <option value="manager" {{ old('form.role', $role) == 'manager' ? 'selected' : '' }}>Manager</option>
                    <option value="trainer" {{ old('form.role', $role) == 'trainer' ? 'selected' : '' }}>Trainer</option>
                    <option value="user" {{ old('form.role', $role) == 'user' ? 'selected' : '' }}>Gebruiker</option>
                </select>
            </div>
        </div>
   @endif

   <div>
        <h2 class="text-2xl font-semibold mb-2">Persoonlijke gegevens</h2>
        
        <div class="grid grid-cols-2 gap-4">
            <x-input.text name="form.name" label="Volledige naam" />
            <x-input.text name="form.email" label="E-mailadres" />

            @if($role == 'user')
                <x-input.date name="form.birth_date" label="Geboortedatum" />
                <x-input.text name="form.phone_number" label="Telefoonnummer" />
            @endif

            <x-input.select name="form.language" label="Taal">
                <option value="nl">Nederlands</option>
                <option value="en">Engels</option>
                <option value="fr">Frans</option>
            </x-input.select>
        </div>
   </div>

   <div>
        <h2 class="text-2xl font-semibold mb-2">Adresgegevens</h2>
        
        <div class="grid grid-cols-2 gap-4">
            @if($role == 'user')
                <x-input.text name="form.street_name" label="Straat" />
                <x-input.text name="form.house_number" label="Huisnummer" />
                <x-input.text name="form.postal_code" label="Postcode" />
                <x-input.text name="form.city" label="Stad" />
            @endif

            <x-input.select name="form.country" label="Land">
                <option value="nl">Nederland</option>
                <option value="be">België</option>
            </x-input.select>

            @if($role == 'user')
                <x-input.text name="form.province" label="Provincie" />
            @endif
        </div>
   </div>

   @if($role == 'user')
        <div>
            <h2 class="text-2xl font-semibold mb-2">Sportschool en trainer</h2>
            
            <div class="grid grid-cols-2 gap-4">
                <x-input.select name="form.branch_id" label="Sportschool">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </x-input.select>

                <x-input.select name="form.trainer_user_id" label="Trainer">
                    @foreach($trainers as $trainer)
                        <option value="{{ $trainer->id }}">{{ $trainer->name }}</option>
                    @endforeach
                </x-input.select>
            </div>
        </div>
   @endif

    <x-input.button type="submit">Opslaan</x-input.button>
</form>