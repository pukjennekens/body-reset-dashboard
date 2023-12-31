<div>
    <div class="grid grid-cols-1 sm:grid-cols-2 gap-4 mb-4">
        <select wire:model.change="selectedServiceId" class="rounded-lg px-4 py-1.5 w-full border border-gray-600 disabled:bg-gray-200">
            <option value="">Selecteer een dienst</option>

            @if(!empty($services))
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            @endif
        </select>

        <select wire:model.change="selectedBranchId" class="rounded-lg px-4 py-1.5 w-full border border-gray-600 disabled:bg-gray-200">
            <option value="">Selecteer een filiaal</option>

            @if(!empty($branches))
                @foreach($branches as $branch)
                    <option value="{{ $branch->id }}">{{ $branch->name }}</option>
                @endforeach
            @endif
        </select>
    </div>

    @if($selectedServiceId && $selectedBranchId)
        <div class="flex flex-col sm:flex-row gap-4 sm:items-center justify-between items-start">
            <h3 class="text-xl font-semibold">{{ $date->format('d-m-Y') }}</h3>

            <div class="flex gap-0 w-full sm:w-auto">
                <button 
                    type="button"
                    class="bg-primary font-bold text-white py-1.5 px-4 hover:bg-green-600 rounded-l-lg cursor-pointer"
                    wire:click="previousDay"
                >
                    <i class="fa-solid fa-caret-left"></i>
                </button>

                <button 
                    type="button" 
                    class="bg-primary font-bold text-white py-1.5 px-4 hover:bg-green-600 w-full sm:w-auto cursor-pointer"
                    wire:click="today"
                >
                    Vandaag
                </button>

                <button 
                    type="button"
                    class="bg-primary font-bold text-white py-1.5 px-4 hover:bg-green-600 rounded-r-lg cursor-pointer"
                    wire:click="nextDay"
                >
                    <i class="fa-solid fa-caret-right"></i>
                </button>
            </div>
        </div>

        <div class="mt-4">
            @if(count($appointments) > 0)
                <table class="table-fixed">
                    <thead>
                        <th>Start tijd</th>
                        <th>Eind tijd</th>
                        <th>Gebruiker</th>
                    </thead>

                    <tbody>
                        @foreach($appointments as $appointment)
                            <tr>
                                <td>{{ $appointment->start->format('d-m-Y H:i') }}</td>
                                <td>{{ $appointment->end->format('d-m-Y H:i') }}</td>
                                <td>{{ $appointment->user->name }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Er zijn geen afspraken gevonden.</p>
            @endif
        </div>
    @endif
</div>