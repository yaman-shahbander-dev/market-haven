<?php

namespace App\Traits;

use JetBrains\PhpStorm\ArrayShape;
use PayPalCheckoutSdk\Core\PayPalHttpClient;
use PayPalCheckoutSdk\Core\SandboxEnvironment;

ini_set('error_reporting', E_ALL); // or error_reporting(E_ALL);
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');

trait PayPalHelper
{
    /**
     * Returns PayPal HTTP client instance with environment that has access
     * credentials context. Use this instance to invoke PayPal APIs, provided the
     * credentials have access.
     */
    public static function client(): PayPalHttpClient
    {
        return new PayPalHttpClient(static::environment());
    }

    /**
     * Set up and return PayPal PHP SDK environment with PayPal access credentials.
     * This sample uses SandboxEnvironment. In production, use LiveEnvironment.
     */
    public static function environment(): SandboxEnvironment
    {
        $clientId = 'AbKEK6zZj7rnouFoBXio8NB_y2Lz63D5LJynQFZT5Dt1L-vmKHR5GkvsZI_hb_5WFXH2JOS_GljPYLMA';
        $clientSecret = 'EEL9gFVz6op1JM230ylH7AtjzQ1BnG8f7wTZK9ngs1Orfbcy-_zZQGjQcq3fw0fJ0mpxC9Au_tYhoZnk';
//        $clientId = getenv("CLIENT_ID") ?: getenv("PAYPAL_SAND_BOX_CLIENT_ID");
//        $clientSecret = getenv("CLIENT_SECRET") ?: getenv("PAYPAL_SAND_BOX_CLIENT_SECRET");
        return new SandboxEnvironment($clientId, $clientSecret);
    }

    #[ArrayShape(['intent' => "string", 'application_context' => "string[]", 'purchase_units' => "\array[][]"])]
    public static function buildOrderRequest(string $currency, float $price): array
    {
        return [
            'intent' => 'CAPTURE',
            'application_context' =>
                [
                    'return_url' => 'https://example.com/return',
                    'cancel_url' => 'https://example.com/cancel',
                    'user_action' => 'PAY_NOW',
                ],
            'purchase_units' =>
                [
                    0 =>
                        [
                            'amount' =>
                                [
                                    'currency_code' => $currency,
                                    'value' => round($price, 2)
                                ]
                        ]
                ]
        ];
    }

    public static function buildPayoutRequestBody(string $receiverId, float $amount, string $currency): string
    {
        return json_decode(
            '{
                "sender_batch_header":
                {
                  "email_subject": "Schoral Payment"
                },
                "items": [
                {
                  "recipient_type": "EMAIL",
                  "receiver": "' . $receiverId . '",
                  "note": "Your ' . $amount . '$ payout",
                  "sender_item_id": "Test_txn_12",
                  "amount":
                  {
                    "currency": "' . $currency . '",
                    "value": "' . $amount . '"
                  }
                }]
              }',
            true
        );
    }
}
