<x-auth-layout>
    <div class="space-y-2">
        <h1 class="text-2xl font-bold">Wachtwoord resetten</h1>

        <p class="text-gray-600">Als je je wachtwoord bent vergeten, kunt je het hier opnieuw instellen. Je ontvangt een e-mail met een link om uw wachtwoord opnieuw in te stellen.</p>

        @livewire('forms.reset-password')
    </div>

    <div class="mt-4">
        <a href="{{ route('auth.login') }}" class="text-sm text-gray-600 hover:underline">Terug naar inloggen</a>
    </div>
</x-auth-layout>