<form class="bg-white shadow-md p-4 rounded-lg" wire:submit.prevent="changePassword">
    @if(!$changed)
        <h3 class="text-xl font-semibold mb-4">
            Wachtwoord wijzigen
        </h3>

        <div class="space-y-2 mb-4">
            <x-input.password name="form.old_password" label="Huidig wachtwoord" />
            <x-input.password name="form.password" label="Nieuw wachtwoord" />
            <x-input.password name="form.password_confirmation" label="Bevestig nieuw wachtwoord" />
        </div>

        <x-input.button>
            Wijzig wachtwoord
        </x-input.button>
    @else
        <p class="px-4 py-2 border border-green-600 bg-green-50 rounded-lg">
            Uw wachtwoord is gewijzigd!
        </p>
    @endif
</form>
