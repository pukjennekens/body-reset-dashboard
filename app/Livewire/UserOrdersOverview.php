<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class UserOrdersOverview extends Component
{
    public $creditOrders;

    public $user;

    public function mount($userId)
    {
        $this->user = User::findOrFail($userId);
        $this->creditOrders = $this->user->creditOrders->sortByDesc('id');
    }

    #[On('order-created')]
    #[On('order-updated')]
    #[On('order-deleted')]
    public function refreshOrders()
    {
        $this->creditOrders = $this->user->creditOrders;
    }

    public function render()
    {
        return view('livewire.user-orders-overview', [
            'creditOrders' => $this->creditOrders,
        ]);
    }
}
