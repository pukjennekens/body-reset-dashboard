<x-auth-layout>
    <div class="space-y-2">
        <h1 class="text-2xl font-bold">Inloggen</h1>

        @livewire('forms.login')
    </div>


    <div class="mt-4">
        <a href="{{ route('auth.reset-password') }}" class="text-sm text-gray-600 hover:underline">Wachtwoord vergeten?</a>
    </div>
</x-auth-layout>