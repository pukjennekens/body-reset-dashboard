@php
    if(!function_exists('formatDay')) {
        function formatDay($day) {
            switch($day) {
                case 'monday': $day = 'Maandag'; break;
                case 'tuesday': $day = 'Dinsdag'; break;
                case 'wednesday': $day = 'Woensdag'; break;
                case 'thursday': $day = 'Donderdag'; break;
                case 'friday': $day = 'Vrijdag'; break;
                case 'saturday': $day = 'Zaterdag'; break;
                case 'sunday': $day = 'Zondag'; break;
            }

            return $day;
        }
    }
@endphp

<div class="px-6 py-4 border border-gray-400 rounded-lg mb-4">
    <h3 class="text-xl font-semibold mb-4">{{ $branchService->service->name }}</h3>

    <table class="table-fixed">
        <thead>
            <tr>
                <th>Dag</th>
                <th>Gesloten</th>
                <th>Openingstijden</th>
                <th>Aantal plekken (trainers voor dienst)</th>
            </tr>
        </thead>
        <tbody>
            @php $days = ['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday']; @endphp
            @foreach( $days as $day )
                <tr x-data="{ openingHours_{!! $branchService->id !!}_{!! $day !!}: @entangle('opening_hours_' . $day) }">
                    <td>{{ formatDay($day) }}</td>

                    <td class="flex items-center gap-2">
                        <label for="openingHours_{!! $branchService->id !!}_{!! $day !!}_closed">
                            <input type="checkbox" id="openingHours_{!! $branchService->id !!}_{!! $day !!}_closed" x-model="openingHours_{!! $branchService->id !!}_{!! $day !!}.closed" class="hidden">
                            <span class="rounded-full text-sm cursor-pointer px-2 py-1 bg-red-200" x-show="openingHours_{!! $branchService->id !!}_{!! $day !!}.closed">Ja</span>
                            <span class="rounded-full text-sm cursor-pointer px-2 py-1 bg-green-200" x-show="!openingHours_{!! $branchService->id !!}_{!! $day !!}.closed">Nee</span>
                        </label>
                    </td>

                    <td>
                        <div class="flex justify-between items-center">
                            <div class="flex flex-col gap-1">
                                <template x-for="(time, index) in openingHours_{!! $branchService->id !!}_{!! $day !!}.times" :key="index">
                                    <div class="flex items-center gap-1">
                                        <input type="time" class="w-24 border px-2" x-model="time.from" />
                                        <span class="mx-2">-</span>
                                        <input type="time" class="w-24 border px-2" x-model="time.to" />
                                        <button type="button" @click="openingHours_{!! $branchService->id !!}_{!! $day !!}.times.splice(index, 1);" class="w-6 h-6 flex items-center justify-center bg-red-500 rounded text-white hover:bg-red-600">
                                            <span class="h-[26px]">&times;</span>
                                        </button>
                                    </div>
                                </template>
                            </div>

                            <button @click="openingHours_{!! $branchService->id !!}_{!! $day !!}.times.push({from: '', to: ''});" class="w-6 h-6 flex items-center justify-center bg-primary rounded text-white hover:bg-green-600">
                                <span class="h-[26px]">&plus;</span>
                            </button>
                        </div>
                    </td>

                    <td>
                        <input type="number" class="w-16 border px-2" x-model="openingHours_{!! $branchService->id !!}_{!! $day !!}.max_participants_per_slot" />
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <button type="submit" class="mt-4 rounded-lg px-4 py-1.5 border-0 bg-primary text-white uppercase font-semibold hover:bg-green-600" wire:click="saveBranchServiceOpeningHours">
        <i class="fas fa-save"></i> Opslaan
    </button>

    @if($success)
    <span class="text-primary ml-4">Opgeslagen! {{ $successCount > 0 ? '(' . $successCount . ')' : '' }}</span>
    @endif
</div>
