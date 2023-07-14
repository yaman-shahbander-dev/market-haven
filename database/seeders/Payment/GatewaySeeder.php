<?php

namespace Database\Seeders\Payment;

use Domain\Payment\Enums\PaymentGatewayEnum;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class GatewaySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        DB::table('payment_gateways')->truncate();
        $gateways = [
            [
                'id' => 1,
                'name' => 'Paypal',
                'key' => PaymentGatewayEnum::PAYPAL->value,
                'disabled_at' => null
            ],
            [
                'id' => 2,
                'name' => 'Stripe',
                'key' => PaymentGatewayEnum::STRIPE->value,
                'disabled_at' => null
            ]
        ];
        DB::table('payment_gateways')->insert($gateways);
    }
}
