<?php

namespace Domain\Payment\Actions\Stripe;

use Lorisleiva\Actions\Concerns\AsAction;
use Exception;
use Stripe\PaymentIntent;
use Stripe\Stripe;
use Stripe\StripeClient;

class GetPaymentAction
{
    use AsAction;

    public function __construct(protected StripeClient $stripeClient)
    {
        Stripe::setApiKey(config('payment.stripe.secret_key'));
    }

    public function handle(string $orderId): Exception|PaymentIntent
    {
        try {
            return $this->stripeClient->paymentIntents->retrieve($orderId);
        } catch (Exception $exception) {
            return $exception;
        }
    }
}
