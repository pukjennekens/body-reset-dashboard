<form wire:submit="resetPassword" class="space-y-4">
    @if(!$submitted)
        <x-input.text name="form.email" label="E-mailadres" value="{{ old('email') }}" />
        <x-input.password name="form.password" label="Nieuw wachtwoord" />
        <x-input.password name="form.password_confirmation" label="Wachtwoord bevestigen" />
        <input type="hidden" name="form.token" wire:model.fill="form.token" value="{{ $token }}">
        @error('form.token') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror

        <x-input.button type="submit">Wachtwoord resetten</x-input.button>
    @else
        <div class="text-green-600 bg-green-100 p-4 rounded-sm">Uw wachtwoord is succesvol gewijzigd.</div>
    @endif
</form>
