<x-auth-layout>
    <div class="space-y-2">
        <h1 class="text-2xl font-bold">Registreren</h1>

        @livewire('forms.registration')
    </div>


    <div class="mt-4">
        <a href="{{ route('auth.login') }}" class="text-sm text-gray-600 hover:underline">Heeft u al een account?</a>
    </div>
</x-auth-layout>