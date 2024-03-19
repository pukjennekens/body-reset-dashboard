<x-auth-layout>
    <div class="space-y-2">
        <h1 class="text-2xl font-bold">Stel uw wachtwoord opnieuw in</h1>

        @livewire('forms.reset-password-token', ['token' => $request->route('token')])
    </div>

    <div class="mt-4">
        <a href="{{ route('auth.login') }}" class="text-sm text-gray-600 hover:underline">Terug naar inloggen</a>
    </div>
</x-auth-layout>