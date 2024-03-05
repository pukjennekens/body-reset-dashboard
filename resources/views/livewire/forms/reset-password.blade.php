<form wire:submit="resetPassword" class="space-y-4">
    @if(!$submitted)
        <x-input.text name="form.email" label="Email" />

        <x-input.button type="submit">Wachtwoord resetten</x-input.button>
    @else
        <div class="text-green-600 bg-green-100 p-4 rounded-sm">Indien het opgegeven e-mailadres bij ons bekend is, ontvangt je een e-mail met een link om uw wachtwoord opnieuw in te stellen.</div>
    @endif
</form>