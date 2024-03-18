<?php

namespace App\Livewire\Forms;

use App\Models\User;
use Livewire\Component;

class Profile extends Component
{
    public ProfileForm $form;
    public User $user;

    public function mount()
    {
        $this->user = auth()->user();

        $this->form->fill([
            'name'         => $this->user->name,
            'email'        => $this->user->email,
            'phone_number' => $this->user->phone_number,
            'birth_date'   => $this->user->birth_date,
            'language'     => $this->user->language,
        ]);
    }

    public function save()
    {
        // Check if the email changed, is so, validate it
        if ($this->user->email !== $this->form->email) {
            $this->form->validate([
                'email' => 'required|string|max:255|email|unique:users,email',
            ]);
        } else {
            $this->form->validate();
        }

        $this->user->update($this->form->toArray());
    }

    public function render()
    {
        return view('livewire.forms.profile');
    }
}
