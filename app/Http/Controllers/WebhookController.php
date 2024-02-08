<?php

namespace App\Http\Controllers;

use App\Models\CreditOrder;
use Illuminate\Http\Request;
use Mollie\Laravel\Facades\Mollie;

class WebhookController extends Controller
{
    public function mollie(Request $request)
    {
        if(!$request->has('id')) return;

        $payment       = Mollie::api()->payments()->get($request->id);
        $creditOrderId = $payment->metadata->credit_order_id;
        $creditOrder   = CreditOrder::find($creditOrderId);

        $creditOrder->update([
            'status'            => $payment->status,
            'order_description' => $payment->description,
            'currency'          => $payment->amount->currency,
            'price'             => $payment->amount->value,
            'payment_id'        => $payment->id,
        ]);

        if($payment->isPaid()) {
            $creditOrder->user->addCredits($creditOrder->creditOption->credits);
            $creditOrder->user->update([
                'credits_expiration_date' => now()->addDays($creditOrder->creditOption->expiration_days),
                'credits_reminder_sent'   => false,
            ]);
        }
    }
}
