<form wire:submit="submit">
    @if(!$created)
        @if($step == 1)
            <h3 class="text-lg font-semibold">Persoonsgegevens</h3>

            <div class="flex flex-col gap-2">
                <x-input.text name="name" label="Naam" />
                <x-input.text name="email" label="E-mailadres" />
                <x-input.text name="phone_number" label="Telefoonnummer" />
                <x-input.date name="birth_date" label="Geboortedatum" />
                <x-input.select name="language" label="Taal">
                    <option value="nl">Nederlands</option>
                    <option value="en">Engels</option>
                    <option value="fr">Frans</option>
                </x-input.select>
            </div>
        @endif

        @if($step == 2)
            <h3 class="text-lg font-semibold">Adres gegevens</h3>

            <div class="flex flex-col gap-2">
                <div class="grid grid-cols-6">
                    <x-input.text name="street" label="Straat" />
                    <x-input.text name="house_number" label="Huisnummer" />
                </div>

                <x-input.text name="postal_code" label="Postcode" />
                <x-input.text name="city" label="Stad" />
                <x-input.text name="province" label="Provincie" />
                <x-input.select name="country" label="Land">
                    <option value="nl">Nederland</option>
                    <option value="be">België</option>
                </x-input.select>
                <x-input.select name="branch_id" label="Vestiging">
                    @foreach($branches as $branch)
                        <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                    @endforeach
                </x-input.select>
            </div>
        @endif

        @if($step == 3)
            <h3 class="text-lg font-semibold">Doel en medische gegevens</h3>

            <div class="flex flex-col gap-2">
                <x-input.textarea name="goal" label="Doel" />
                <x-input.textarea name="medical_operations" label="Medische ingrepen" />
                <x-input.textarea name="medications_or_supplements" label="Medicatie" />
                <x-input.textarea name="fysical_complaints" label="Fysieke klachten" />
            </div>
        @endif

        <div class="text-right mt-4">
            <x-input.button type="submit">
                @if($step != 3)
                    Volgende
                @else
                    Registreren
                @endif
            </x-input.button>
        </div>
    @else
        <div>
            <h3 class="text-lg font-semibold">Bedankt voor het registreren!</h3>
            <p>Je ontvangt een e-mail met verdere instructies.</p>
        </div>
    @endif
</form>
