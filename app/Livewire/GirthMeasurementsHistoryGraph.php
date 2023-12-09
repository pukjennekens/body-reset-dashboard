<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

class GirthMeasurementsHistoryGraph extends Component
{
    public User $user;

    public $labels                  = [];
    public $chestMeasurements       = [];
    public $hipsMeasurements        = [];
    public $thighMeasurements       = [];
    public $underBreastMeasurements = [];
    public $upperArmMeasurements    = [];
    public $waistMeasurements       = [];

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);

        $girthMeasurements = $this->user->girthMeasurements()->orderBy('date', 'asc');

        foreach ($girthMeasurements->get() as $measurement) {
            $this->labels[]                  = $measurement->date->format('d-m-Y');
            $this->chestMeasurements[]       = $measurement->chest;
            $this->hipsMeasurements[]        = $measurement->hips;
            $this->thighMeasurements[]       = $measurement->thigh;
            $this->underBreastMeasurements[] = $measurement->under_breast;
            $this->upperArmMeasurements[]    = $measurement->upper_arm;
            $this->waistMeasurements[]       = $measurement->waist;
        }
    }

    public function render()
    {
        return view('livewire.girth-measurements-history-graph');
    }
}
