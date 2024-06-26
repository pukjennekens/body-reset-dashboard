<div>
    <div>
        <h3 class="text-2xl font-semibold mb-4">Maak een afspraak</h3>

        <div>
            <label for="select-service" class="block mb-1">Selecteer een dienst</label>
            <select 
                class="rounded-lg px-4 py-1.5 w-full border border-gray-600 disabled:bg-gray-200 bg-white"
                wire:change="selectService($event.target.value)"
                id="select-service"
            >
                <option value="">Selecteer een dienst</option>
                @foreach($services as $service)
                    <option value="{{ $service->id }}">{{ $service->name }}</option>
                @endforeach
            </select>
        </div>
    </div>

    @if($serviceId)
        <div class="flex flex-col sm:flex-row gap-4 sm:items-center justify-between items-start mt-8">
            <h3 class="text-2xl font-semibold">{{ $month }} {{ $year }}</h3>

            <div class="flex gap-0 w-full sm:w-auto">
                <button 
                    type="button"
                    class="bg-primary font-bold text-white py-1.5 px-4 hover:bg-green-600 rounded-l-lg cursor-pointer"
                    wire:click="previousWeek"
                    wire:loading.attr="disabled"
                >
                    <i class="fa-solid fa-caret-left" wire:loading.remove wire:target="previousWeek"></i>
                    <i class="fa-solid fa-spinner fa-spin" wire:loading wire:target="previousWeek"></i>
                </button>

                <button 
                    type="button" 
                    class="bg-primary font-bold text-white py-1.5 px-4 hover:bg-green-600 w-full sm:w-auto cursor-pointer"
                    wire:click="today"
                    wire:loading.attr="disabled"
                >
                    <span wire:loading.remove wire:target="today">Vandaag</span>
                    <span wire:loading wire:target="today">Laden...</span>
                </button>

                <button 
                    type="button"
                    class="bg-primary font-bold text-white py-1.5 px-4 hover:bg-green-600 rounded-r-lg cursor-pointer"
                    wire:click="nextWeek"
                    wire:loading.attr="disabled"
                >
                    <i class="fa-solid fa-caret-right" wire:loading.remove wire:target="nextWeek"></i>
                    <i class="fa-solid fa-spinner fa-spin" wire:loading wire:target="nextWeek"></i>
                </button>
            </div>
        </div>

        <div class="my-4 inline-flex flex-col items-start gap-2 md:flex-row md:items-center md:gap-4">
            <div class="inline-flex items-center">
                <div class="w-5 h-5 rounded-md bg-primary"></div>
                <span class="ml-2">Beschikbaar</span>
            </div>

            <div class="inline-flex items-center">
                <div class="w-5 h-5 rounded-md bg-yellow-400"></div>
                <span class="ml-2">Nog één plek beschikbaar</span>
            </div>

            <div class="inline-flex items-center">
                <div class="w-5 h-5 rounded-md bg-blue-400"></div>
                <span class="ml-2">Door jou geboekt</span>
            </div>

            <div class="inline-flex items-center">
                <div class="w-5 h-5 rounded-md bg-red-500"></div>
                <span class="ml-2">Niet beschikbaar</span>
            </div>

            <div class="inline-flex items-center">
                <div class="w-5 h-5 rounded-md bg-red-200"></div>
                <span class="ml-2">Credits vervallen</span>
            </div>
        </div>

        <div class="mb-4">
            <p><i class="fas fa-info-circle"></i> <strong>{{ $this->service->name }}</strong> kost {{ $this->service->price }} {{ $this->service->price == 1 ? 'credit' : 'credits' }}.</p>
        </div>

        <div class="flex border rounded-lg overflow-x-auto bg-white shadow-md px-4 transition-all" wire:loading.class="opacity-50 pointer-events-none">
            @foreach($days as $day)
                <div class="min-w-[140px] w-full">
                    <div class="flex flex-col items-center px-2 py-4">
                        <span class="font-bold">{{ $day->format('d') }}</span>
                        <span>{{ \Carbon\Carbon::parse($day)->translatedFormat('l') }}</span>
                    </div>

                    <div class="flex flex-col gap-2 items-center px-2 py-4 border-t border-gray-400">
                        @if(isset($slots[$day->format('d-m-Y')]))
                            @foreach($slots[$day->format('d-m-Y')] as $slot)
                                <button 
                                    type="button"
                                    class="w-full font-semibold text-center py-2 rounded-md cursor-pointer inline-block {{ $slot['creditsExpired'] ? 'bg-red-200 cursor-not-allowed' : ($slot['available'] ? ( $slot['maxAppointments'] > 1 ? ($slot['maxAppointments'] - $slot['numberOfAppointments'] == 1 ? 'bg-yellow-400 text-white hover:bg-yellow-500' : 'bg-primary text-white hover:bg-green-600') : 'bg-primary text-white hover:bg-green-600' ) : ($slot['bookedByUser'] ? 'bg-blue-400 text-white cursor-not-allowed' : 'bg-red-500 text-white cursor-not-allowed')) }}"
                                    @if($slot['available'])
                                        wire:click="$dispatch('openModal', {component: 'make-appointment', arguments: {date: '{{ $slot['date'] }}', from: '{{ $slot['from'] }}', to: '{{ $slot['to'] }}', serviceId: {{ $this->service->id }}, branchId: {{ $this->branch->id }}, userId: {{ $this->user->id }}}})"
                                    @endif
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