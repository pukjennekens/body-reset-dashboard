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
        $this->girthMeasurements = $this->user->girthMeasurements->sortByDesc('date');
    }

    #[On('girth-measurement-created')]
    #[On('girth-measurement-deleted')]
    public function refreshgirthMeasurements($userId)
    {
        $this->user = User::find($userId);
        $this->girthMeasurements = $this->user->girthMeasurements->sortByDesc('date');;
    }

    public function render()
    {
        return view('livewire.girth-measurements-table', [
            'girthMeasurements' => $this->girthMeasurements,
        ]);
    }
}
