<form wire:submit="saveBranchServices" class="w-full">
    <div class="flex flex-col mb-4">
        @foreach( $allServices as $service )
            <label for="service-{{ $service->id }}" class="inline-flex items-center mt-3">
                <input type="checkbox" id="service-{{ $service->id }}" value="{{ $service->id }}" wire:model.defer="services" class="text-gray-600" @if( $this->branch->services->contains($service->id) ) checked @endif>
                <span class="ml-2 text-gray-700">{{ $service->name }}</span>
            </label>
            @error('services.' . $service->id) <span class="text-red-500">{{ $message }}</span> @enderror
        @endforeach

        @error('services') <span class="text-red-500">{{ $message }}</span> @enderror
    </div>

    <x-input.button type="submit">Opslaan</x-input.button>
</form>