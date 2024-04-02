<?php

namespace App\Livewire\Forms;

use Livewire\Component;
use App\Models\Branch;
use App\Models\User;
use App\Notifications\UserRegistered;

class Registration extends Component
{
    public $branches = [];
    public $step     = 1;
    public $created  = false;

    public $name;
    public $email;
    public $phone_number;
    public $birth_date;
    public $language;
    public $street;
    public $house_number;
    public $postal_code;
    public $city;
    public $province;
    public $country;
    public $branch_id;
    public $goal;
    public $medical_operations;
    public $medications_or_supplements;
    public $fysical_complaints;

    public function mount()
    {
        $this->branches = Branch::notHidden()->get();
    }

    protected function rules()
    {
        if ($this->step === 1) {
            return [
                'name'     => 'required',
                'email'    => 'required|email|unique:users,email',
                'phone_number'    => 'required',
                'birth_date' => 'required',
                'language' => 'required|in:nl,en,fr',
            ];
        } elseif ($this->step === 2) {
            return [
                'street'       => 'required',
                'house_number' => 'required',
                'postal_code'  => 'required',
                'city'         => 'required',
                'province'     => 'required',
                'country'      => 'required',
                'branch_id'    => 'required|exists:branches,id',
            ];
        } elseif ($this->step === 3) {
            return [
                'goal'                      => 'required',
                'medical_operations'        => 'nullable|string',
                'medications_or_supplements'=> 'nullable|string',
                'fysical_complaints'        => 'nullable|string',
            ];
        }

        return [];
    }

    public function submit()
    {
        $this->validate();
        $this->step < 4 ? $this->step++ : $this->save();

        if ($this->step == 4) {
            // Save the registration to the database
            $user = new User([
                'name'         => $this->name,
                'email'        => $this->email,
                'phone_number' => $this->phone_number,
                'birth_date'   => $this->birth_date,
                'language'     => $this->language,
                'street_name'  => $this->street,
                'house_number' => $this->house_number,
                'postal_code'  => $this->postal_code,
                'city'         => $this->city,
                'province'     => $this->province,
                'country'      => $this->country,
                'password'     => bcrypt(rand(100000, 999999)),
                'branch_id'    => $this->branch_id,
            ]);

            $user->save();

            $user->anamnesis()->create([
                'goal'                      => $this->goal,
                'medical_operations'        => $this->medical_operations,
                'medications_or_supplements'=> $this->medications_or_supplements,
                'fysical_complaints'        => $this->fysical_complaints,
            ]);

            // Notify all users who have the notify_on_registration flag set to true
            $users = User::where('notify_on_registration', true)->get();
            foreach ($users as $_user) {
                $user->notify(new UserRegistered($user));
            }

            return redirect()->away('https://bodyreset.be/super-je-dossier-werd-aangemaakt/');
        }
    }

    public function render()
    {
        return view('livewire.forms.registration');
    }
}
