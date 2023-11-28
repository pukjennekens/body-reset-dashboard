<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserNutritionPlansTable extends Component
{
    public User $user;
    public $nutritionPlans = [];

    public function mount($userId)
    {
        $this->user = User::find($userId) ?? new User();
        $this->nutritionPlans = $this->user->nutritionPlans->sortBy('date');
    }

    #[On('nutritionPlanCreated')]
    #[On('nutritionPlanDeleted')]
    public function refreshNutritionPlans($userId)
    {
        $this->user = User::find($userId);
        $this->nutritionPlans = $this->user->nutritionPlans->sortBy('date');
    }

    public function render()
    {
        return view('livewire.user-nutrition-plans-table');
    }
}
