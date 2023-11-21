<div>
    <label for="{{ $attributes->get('name') }}" class="block mb-1">{{ $attributes->get('label') }}</label>
    <select class="rounded-lg px-4 py-1.5 w-full border border-gray-600 disabled:bg-gray-200" wire:model.fill="{{ $attributes->get('name') }}" @if($attributes->get('disabled')) disabled @endif>
        {{ $slot }}
    </select>
    @error($attributes->get('name')) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror 
</div>