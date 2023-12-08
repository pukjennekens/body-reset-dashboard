<?php

namespace App\Livewire;

use App\Models\BodyCompositionMeasurement;
use App\Models\User;
use Livewire\Component;

class WeightDistributionGraph extends Component
{
    public User $user;
    public $measurement;
    public $labels = [];

    public function mount($userId)
    {
        $this->user        = User::findOrFail($userId);
        $measurement       = $this->user->mostRecentBodyCompositionMeasurement();

        $this->measurement = [
            'fat_percentage'  => $measurement->fat_percentage ?? '0',
            'bone_mass'       => $measurement->bone_mass ?? '0',
            'muscle_mass'     => $measurement->muscle_mass ?? '0',
        ];

        
    }

    public function render()
    {
        return view('livewire.weight-distribution-graph');
    }
}
