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
        // to be changed
        Stripe::setApiKey(config('payment.stripe.secret_key', 'sk_test_51L1rOdH3qVRn63M2RAD1z9kXYZ7HsWjqBkq0uXtR2CbzDSTR7VdMPSJqrCV42f7nc8OevRcjsOxeff006KlblTu200ot5FS4HA'));
    }

    public function handle(Order $order): Exception|PaymentIntent
    {
        try {
            return $this->stripeClient->paymentIntents->create([
                'amount' => $order->price,
                'currency' => 'USD', // to be changed
                'payment_method_types' => ['card'],
                'capture_method' => "manual",
            ]);
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
