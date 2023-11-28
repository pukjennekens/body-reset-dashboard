<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;

class BodyCompositionMeasurementsTable extends Component
{
    public $user;
    public $bodyCompositionMeasurements;

    public function mount($id = null)
    {
        $this->user = User::find($id) ?? new User();
        $this->bodyCompositionMeasurements = $this->user->bodyCompositionMeasurements->sortBy('date');
    }

    #[On('body-composition-measurement-created')]
    #[On('body-composition-measurement-deleted')]
    public function refreshBodyCompositionMeasurements($userId)
    {
        $this->user = User::find($userId);
        $this->bodyCompositionMeasurements = $this->user->bodyCompositionMeasurements->sortBy('date');
    }

    public function render()
    {
        return view('livewire.body-composition-measurements-table', [
            'bodyCompositionMeasurements' => $this->bodyCompositionMeasurements,
        ]);
    }
}
