<x-auth-layout>
    <div class="space-y-2">
        <h1 class="text-2xl font-bold">Stel uw wachtwoord opnieuw in</h1>

        @livewire('forms.reset-password-token', ['token' => $request->route('token')])
    </div>
</x-auth-layout>