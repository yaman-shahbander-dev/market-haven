<?php

namespace Domain\Review\Actions\User;

use Domain\Review\DataTransferObjects\ReviewData;
use Domain\Review\Models\Review;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;

class CreateReviewAction
{
    use AsAction;

    public function __construct(protected Review $review)
    {
    }

    public function handle(ReviewData $data): ReviewData|null
    {
        $review = QueryBuilder::for($this->review)
            ->create([
                'reviewable_type' => $data->reviewableType,
                'reviewable_id' => $data->reviewableId,
                'user_id' => $data->userId,
                'rating' => $data->rating,
                'review' => $data->review,
            ]);

        return $review ? ReviewData::from($review) : null;
    }
}
