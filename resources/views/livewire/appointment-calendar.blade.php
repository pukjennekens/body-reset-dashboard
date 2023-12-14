<div>
    <div>
        <h3 class="text-2xl font-semibold mb-2">Selecteer een dienst</h3>

        <select 
            class="rounded-lg px-4 py-1.5 w-full border border-gray-600 disabled:bg-gray-200"
            wire:change="selectService($event.target.value)"
        >
            <option value="">Selecteer een dienst</option>
            @foreach($services as $service)
                <option value="{{ $service->id }}">{{ $service->name }}</option>
            @endforeach
        </select>
    </div>

    @if($serviceId)
        <div class="flex flex-col sm:flex-row gap-4 sm:items-center justify-between items-start mt-8">
            <h3 class="text-2xl font-semibold">{{ $month }} {{ $year }}</h3>

            <div class="flex gap-0 w-full sm:w-auto">
                <button 
                    type="button"
                    class="bg-primary font-bold text-white py-1.5 px-4 hover:bg-green-600 rounded-l-lg cursor-pointer"
                    wire:click="previousWeek"
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
                    wire:click="nextWeek"
                >
                    <i class="fa-solid fa-caret-right"></i>
                </button>
            </div>
        </div>

        <div class="flex mt-8 border border-gray-400 rounded-lg overflow-x-auto">
            @foreach($days as $day)
                <div class="min-w-[140px] w-full">
                    <div class="flex flex-col items-center px-2 py-4">
                        <span class="font-bold">{{ $day->format('d') }}</span>
                        <span>{{ $day->format('l') }}</span>
                    </div>

                    <div class="flex flex-col gap-2 items-center px-2 py-4 border-t border-gray-400">
                        @if(isset($slots[$day->format('d-m-Y')]))
                            @foreach($slots[$day->format('d-m-Y')] as $slot)
                                <button 
                                    type="button"
                                    class="w-full font-semibold text-center py-2 rounded-md {{ $slot['available'] ? 'bg-primary text-white hover:bg-green-600' : 'bg-red-200 text-gray-900'  }}"
                                >
                                    <span>{{ $slot['from'] }} - {{ $slot['to'] }}</span>
                                </button>
                            @endforeach
                        @else
                            <p class="text-center text-xs italic font-bold">
                                Geen beschikbare tijden
                            </p>
                        @endif
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>