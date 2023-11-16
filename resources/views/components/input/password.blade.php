<div>
    <label for="{{ $attributes->get('name') }}" class="block mb-1">{{ $attributes->get('label') }}</label>
    <input type="password" class="rounded-lg px-4 py-1.5 w-full border border-gray-600" wire:model="{{ $attributes->get('name') }}">
    @error($attributes->get('name')) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror 
</div>