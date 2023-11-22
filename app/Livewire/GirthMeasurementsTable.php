<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\User;
use Livewire\Attributes\On;

class GirthMeasurementsTable extends Component
{
    public $user;
    public $girthMeasurements;

    public function mount($id = null)
    {
        $this->user = User::find($id) ?? new User();
        $this->girthMeasurements = $this->user->girthMeasurements;
    }

    #[On('girth-measurement-created')]
    #[On('girth-measurement-deleted')]
    public function refreshgirthMeasurements($userId)
    {
        $this->user = User::find($userId);
        $this->girthMeasurements = $this->user->girthMeasurements;
    }

    public function deleteGirthMeasurement($id)
    {
        $girthMeasurement = $this->user->girthMeasurements()->find($id);
        $girthMeasurement->delete();

        $this->dispatch('girth-measurement-deleted', userId: $this->user->id);
        $this->dispatch('user-updated', id: $this->user->id);
    }

    public function render()
    {
        return view('livewire.girth-measurements-table', [
            'girthMeasurements' => $this->girthMeasurements,
        ]);
    }
}
