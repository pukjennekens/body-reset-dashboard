<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Log;
use Livewire\Component;

class BodyCompositionHistoryGraph extends Component
{
    public User $user;
    public $labels                      = [];
    public $fatMassMeasurements         = [];
    public $boneMassMeasurements        = [];
    public $muscleMassMeasurements      = [];
    public $waterPercentageMeasurements = [];

    public function mount($userId)
    {
        $this->user = User::find($userId);

        $bodyCompositionMeasurements = $this->user->bodyCompositionMeasurements()->orderBy('date', 'asc');

        foreach ($bodyCompositionMeasurements->get() as $measurement) {
            $this->labels[]                      = $measurement->date->format('d-m-Y');
            $this->fatMassMeasurements[]         = $measurement->fat_percentage;
            $this->boneMassMeasurements[]        = $measurement->bone_mass;
            $this->muscleMassMeasurements[]      = $measurement->muscle_mass;
            $this->waterPercentageMeasurements[] = $measurement->water_percentage;
        }
    }

    public function render()
    {
        return view('livewire.body-composition-history-graph');
    }
}
