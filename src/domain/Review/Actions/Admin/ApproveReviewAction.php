<?php

namespace Domain\Review\Actions\Admin;

use Domain\Review\Models\Review;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ApproveReviewAction
{
    use AsAction;

    public function __construct(protected Review $review)
    {
    }

    public function handle(string $id): bool
    {
        return QueryBuilder::for($this->review)
            ->where('id', $id)
            ->update(['approved_at' => now()]);
    }
}
