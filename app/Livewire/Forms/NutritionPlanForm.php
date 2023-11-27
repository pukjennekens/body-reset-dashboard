<?php

namespace App\Livewire\Forms;

use Livewire\Attributes\Rule;
use Livewire\Form;

class NutritionPlanForm extends Form
{
    #[Rule('date|required')]
    public string $date;

    #[Rule('nullable|string')]
    public string $remark;

    #[Rule('nullable|string')]
    public string $remark_internal;

    #[Rule('nullable|string')]
    public string $remark_monday;

    #[Rule('nullable|string')]
    public string $remark_tuesday;

    #[Rule('nullable|string')]
    public string $remark_wednesday;

    #[Rule('nullable|string')]
    public string $remark_thursday;

    #[Rule('nullable|string')]
    public string $remark_friday;

    #[Rule('nullable|string')]
    public string $remark_saturday;

    #[Rule('nullable|string')]
    public string $remark_sunday;
}
