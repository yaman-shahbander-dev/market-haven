<?php

namespace Domain\Order\Actions\User;

use Domain\Order\Models\Order;
use Domain\Order\States\Pending;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CheckUserActiveOrdersAction
{
    use AsAction;

    public function __construct(
        protected Order $order
    ) {
    }

    public function handle(string $userId): bool
    {
        return QueryBuilder::for($this->order)
            ->where('expired_at', '>=', now())
            ->where('user_id', $userId)
            ->where('state', Pending::getMorphClass())
            ->exists();
    }
}
