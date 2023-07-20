<?php

namespace Domain\Payment\Actions\Stripe;

use Exception;
use Lorisleiva\Actions\Concerns\AsAction;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;

class ConfirmPaymentAction
{
    use AsAction;

    public function __construct(protected StripeClient $stripeClient)
    {
        Stripe::setApiKey(config('payment.stripe.secret_key', 'sk_test_51L1rOdH3qVRn63M2RAD1z9kXYZ7HsWjqBkq0uXtR2CbzDSTR7VdMPSJqrCV42f7nc8OevRcjsOxeff006KlblTu200ot5FS4HA'));
    }

    public function handle(string $orderId): Exception|PaymentIntent
    {
        try {
            return $this->stripeClient->paymentIntents->capture($orderId);
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
