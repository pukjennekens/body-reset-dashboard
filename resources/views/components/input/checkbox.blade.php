<div>
    <label for="{{ $attributes->get('name') }}" class="mb-1 flex items-center justify-start gap-2">
        <input type="checkbox" class="rounded-lg px-4 py-1.5 border border-gray-600 disabled:bg-gray-200" wire:model.fill="{{ $attributes->get('name') }}" value="{{ $attributes->get('value') }}" @if($attributes->get('disabled')) disabled @endif @if($attributes->get('checked')) checked @endif>
        <span>{{ $attributes->get('label') }}</span>
    </label>
    @error($attributes->get('name')) <span class="text-red-500 text-sm">{{ $message }}</span> @enderror 
</div>