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
        $this->bodyCompositionMeasurements = $this->user->bodyCompositionMeasurements;
    }

    #[On('body-composition-ceasurement-created')]
    #[On('body-composition-ceasurement-deleted')]
    public function refreshBodyCompositionMeasurements($userId)
    {
        $this->user = User::find($userId);
        $this->bodyCompositionMeasurements = $this->user->bodyCompositionMeasurements;
    }

    public function deleteBodyCompositionMeasurement($id)
    {
        $bodyCompositionMeasurement = $this->user->bodyCompositionMeasurements()->find($id);
        $bodyCompositionMeasurement->delete();

        $this->dispatch('body-composition-ceasurement-deleted', userId: $this->user->id);
    }

    public function render()
    {
        return view('livewire.body-composition-measurements-table', [
            'bodyCompositionMeasurements' => $this->bodyCompositionMeasurements,
        ]);
    }
}
