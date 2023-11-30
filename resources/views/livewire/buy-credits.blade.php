<div class="buy-credits-form">
    <h2 class="text-2xl font-semibold mb-4">Credits aanvullen</h2>

    <form wire:submit.prevent="buyCredits">
        <div class="flex flex-col gap-2 mb-4">
            @foreach ($creditOptions as $option)
                <label class="px-4 py-2 rounded-lg border border-gray-400 flex gap-4 cursor-pointer">
                    <input type="radio" name="creditOption" value="{{ $option->id }}" wire:model="selectedCreditOption">

                    <div>
                        <h3 class="text-lg font-semibold">{{ $option->name }}</h3>
                        <p>€ {{ number_format($option->price, 2, ',', '.') }}</p>
                        <small class="italic">{{ $option->validityPeriodString() }}</small>
                    </div>
                </label>
            @endforeach
        </div>

        @error('selectedCreditOption') <span class="text-red-500 text-sm">{{ $message }}</span> @enderror 

        <button type="submit" class="px-8 py-4 bg-primary text-white w-full mt-4 rounded-lg text-xl uppercase font-semibold hover:bg-green-600">
            Betalen
        </button>
    </form>
</div>
