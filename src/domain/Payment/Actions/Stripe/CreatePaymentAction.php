<?php

namespace Domain\Payment\Actions\Stripe;

use Domain\Order\Models\Order;
use Lorisleiva\Actions\Concerns\AsAction;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;
use Exception;

class CreatePaymentAction
{
    use AsAction;

    public function __construct(protected StripeClient $stripeClient)
    {
        Stripe::setApiKey(config('payment.stripe.secret_key'));
    }

    public function handle(Order $order): Exception|PaymentIntent
    {
        try {
            return $this->stripeClient->paymentIntents->create([
                'amount' => $order->price,
                'currency' => 'USD',
                'payment_method_types' => ['card'],
                'capture_method' => "manual",
            ]);
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
