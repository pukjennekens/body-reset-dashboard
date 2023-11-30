<?php

namespace App\Livewire;

use App\Models\CreditOption;
use App\Models\CreditOrder;
use Illuminate\Support\Facades\Log;
use LivewireUI\Modal\ModalComponent;
use Mollie\Laravel\Facades\Mollie;

class BuyCredits extends ModalComponent
{
    public $creditOptions;
    public $selectedCreditOption;

    public function mount()
    {
        $this->creditOptions = CreditOption::all()->sortBy('sort_order');
    }

    public function buyCredits()
    {
        $this->validate([
            'selectedCreditOption' => 'required|exists:credit_options,id',
        ]);

        $creditOption = CreditOption::find($this->selectedCreditOption);

        $payment = Mollie::api()->payments()->create([
            'amount' => [
                'currency' => 'EUR',
                'value'    => number_format($creditOption->price, 2),
            ],
            'description' => $creditOption->credits . ' credits. ' . $creditOption->validityPeriodString(),
            'redirectUrl' => route('dashboard'),
            'webhookUrl'  => 'https://google.com', // route('webhooks.mollie'),
        ]);

        CreditOrder::create([
            'user_id'           => auth()->id(),
            'credit_option_id'  => $this->selectedCreditOption,
            'payment_method'    => null,
            'status'            => $payment->status,
            'order_description' => $payment->description,
            'currency'          => $payment->amount->currency,
            'price'             => $payment->amount->value,
            'payment_id'        => $payment->id,
        ]);

        return redirect($payment->getCheckoutUrl(), 303);
    }

    public function render()
    {
        return view('livewire.buy-credits');
    }
}
