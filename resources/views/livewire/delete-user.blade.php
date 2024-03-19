<div>
    <h2 class="text-2xl font-semibold mb-4">Account verwijderen</h2>

    @if(!$user->hasRole('user'))
        <x-input.select name="transferTo" label="Selecteer een gebruiker om alle gegevens naar over te zetten" wire:model="transferTo">
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }} ({{ $user->role }})</option>
            @endforeach
        </x-input.select>
    @endif

    @if(!auth()->user()->hasRole(['admin', 'manager', 'trainer']))
        <x-input.password name="password" label="Wachtwoord" wire:model="password" />
    @endif

    <div x-data="{ confirm: false }">
        <button x-show="!confirm" type="button" x-on:click="confirm = true" class="rounded-lg px-4 py-1.5 border-0 bg-red-500 text-white uppercase font-semibold hover:bg-red-600">Verwijderen</button>

        <div x-show="confirm" x-on:click.outside="confirm = false">
            <p class="bg-red-100 text-sm mb-4 rounded-lg py-2 px-4 border-red-500 border text-red-500 flex items-center gap-2">
                <i class="fas fa-exclamation-triangle mr-2"></i>

                <span>
                    Weet je zeker dat je dit account wilt verwijderen?

                    @if($user->hasRole('user'))
                        <br>
                        Dat betekent dat alle gegevens van dit gebruikersaccount zullen worden verwijderd en niet meer kunnen worden hersteld. Dit kan niet ongedaan worden gemaakt.
                    @endif
                </span>
            </p>

            <div class="flex items-center gap-2">
                <button type="button" x-on:click="confirm = false" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600">Annuleren</button>
                <button type="button" wire:click="deleteUser" class="rounded-lg px-4 py-1.5 border-0 bg-red-500 text-white uppercase font-semibold hover:bg-red-600 ml-2">Bevestigen</button>
            </div>
        </div>
    </div>
</div>
