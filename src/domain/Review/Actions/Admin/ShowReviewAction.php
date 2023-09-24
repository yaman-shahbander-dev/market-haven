<?php

namespace Domain\Review\Actions\Admin;

use Domain\Review\DataTransferObjects\ReviewData;
use Domain\Review\Models\Review;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class ShowReviewAction
{
    use AsAction;

    public function __construct(protected Review $review)
    {
    }

    public function handle(string $id): ReviewData|null
    {
        $review = QueryBuilder::for($this->review)
            ->where('id', $id)
            ->first();

        return $review ? ReviewData::from($review) : null;
    }
}
