<div class="space-y-2">
    <h2 class="text-2xl font-semibold">Weet je zeker dat je dit recept wilt verwijderen?</h2>

    <p>
        Het uitvoeren van deze actie kan niet ongedaan worden gemaakt.
    </p>

    @error('deletion')
        <p class="bg-red-200 rounded-lg border border-red-500 text-red-500 text-sm px-4 py-2 mt-2">{{ $message }}</p>
    @enderror

    <div>
        <hr class="my-4">
    </div>

    <div class="flex justify-end gap-2">
        <button wire:click="cancel" class="rounded-lg px-4 py-1.5 border-0 bg-primary text-sm text-white uppercase font-semibold hover:bg-green-600">Annuleren</button>
        <button wire:click="deleteRecipe" class="rounded-lg px-4 py-1.5 border-0 bg-red-500 text-sm text-white uppercase font-semibold hover:bg-red-700">Verwijderen</button>
    </div>
</div>
