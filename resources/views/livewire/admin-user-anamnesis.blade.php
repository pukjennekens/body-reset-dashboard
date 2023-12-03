<div>
    @if($user->anamnesis)
        @livewire('forms.anamnesis', ['userId' => $user->id])
    @else
        <p class="mb-4">
            Er is nog geen anamnese ingevuld.
        </p>

        <button class="rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600" x-data="" x-on:click.prevent="$dispatch('openModal', {component: 'forms.anamnesis', arguments: {userId: {{ $user->id }}}})">
            Aanmaken
        </button>
    @endif
</div>
