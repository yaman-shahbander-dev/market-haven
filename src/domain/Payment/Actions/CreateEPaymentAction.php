<?php

namespace Domain\Payment\Actions;

use Domain\Payment\DataTransferObjects\EPaymentData;
use Domain\Payment\Models\EPayment;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateEPaymentAction
{
    use AsAction;

    public function __construct(
        protected EPayment $ePayment
    ) {
    }

    public function handle(EPaymentData $data): ?EPaymentData
    {
        $ePayment = QueryBuilder::for($this->ePayment)
            ->create($data->toArray());

        return $ePayment ? EPaymentData::from($ePayment) : null;
    }
}
