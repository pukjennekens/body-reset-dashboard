<form class="space-y-4" wire:submit.prevent="update">
    <x-input.select name="form.module" label="Module">
        <option value="A" {{ $appointment->module === 'A' ? 'selected' : '' }}>A</option>
        <option value="B" {{ $appointment->module === 'B' ? 'selected' : '' }}>B</option>
        <option value="C" {{ $appointment->module === 'C' ? 'selected' : '' }}>C</option>
        <option value="D" {{ $appointment->module === 'D' ? 'selected' : '' }}>D</option>
    </x-input.select>

    <div>
        <label for="submodules" class="mb-1 block">Submodules</label>
        
        @foreach(['Rug', 'Schouders & Nek', 'Knie', 'Diverse', 'To Do'] as $submodule)
            <label for="{{ $submodule }}" class="flex items-center justify-start gap-2">
                <input type="checkbox" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200" wire:model="submodules" value="{{ $submodule }}" @if(in_array($submodule, $submodules)) checked @endif>
                <span>{{ strtoupper($submodule) }}</span>
            </label>
        @endforeach
    </div>

    <x-input.textarea name="form.cardio" label="Cardio" />

    <x-input.textarea name="form.notes" label="Opmerkingen" />

    <x-input.button type="submit">
        {{ __('Opslaan') }}
    </x-input.button>
</form>
