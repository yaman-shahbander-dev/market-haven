<?php

namespace Domain\Review\Actions\Admin;

use Domain\Review\DataTransferObjects\ReviewData;
use Domain\Review\Models\Review;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;

class GetReviewsAction
{
    use AsAction;

    public function __construct(protected Review $review)
    {
    }

    public function handle(): PaginatedDataCollection|null
    {
        $reviews = QueryBuilder::for($this->review)
            ->paginate();

        return $reviews ? ReviewData::collection($reviews) : null;
    }
}
