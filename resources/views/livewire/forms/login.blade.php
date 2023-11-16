<form wire:submit="login" class="space-y-4">
    <x-input.text name="form.email" label="Email" />

    <x-input.password name="form.password" label="Wachtwoord" />

    <x-input.button type="submit">Inloggen</x-input.button>
</form>
