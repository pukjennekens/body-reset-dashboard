<div>
    <div class="flex flex-col sm:flex-row gap-4 sm:items-center justify-between items-start">
        <h3 class="text-2xl font-semibold">{{ $month }} {{ $year }}</h3>

        <div class="flex gap-0 w-full sm:w-auto">
            <button 
                type="button"
                class="bg-primary font-bold text-white py-1.5 px-4 hover:bg-green-600 rounded-l-lg"
                wire:click="previousWeek"
            >
                <i class="fa-solid fa-caret-left"></i>
            </button>

            <button 
                type="button" 
                class="bg-primary font-bold text-white py-1.5 px-4 hover:bg-green-600 w-full sm:w-auto"
                wire:click="today"
            >
                Vandaag
            </button>

            <button 
                type="button"
                class="bg-primary font-bold text-white py-1.5 px-4 hover:bg-green-600 rounded-r-lg"
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
                    <span class="w-full bg-primary text-white font-semibold text-center py-2 rounded-md cursor-pointer">8:30 - 9:30</span>
                    <span class="w-full bg-primary text-white font-semibold text-center py-2 rounded-md cursor-pointer">9:30 - 10:30</span>
                    <span class="w-full bg-primary text-white font-semibold text-center py-2 rounded-md cursor-pointer">10:30 - 11:30</span>
                    <span class="w-full bg-primary text-white font-semibold text-center py-2 rounded-md cursor-pointer">11:30 - 12:30</span>
                    <span class="w-full bg-primary text-white font-semibold text-center py-2 rounded-md cursor-pointer">12:30 - 13:30</span>
                </div>
            </div>
        @endforeach
    </div>
</div>