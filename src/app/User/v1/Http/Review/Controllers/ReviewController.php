<?php

namespace App\User\v1\Http\Review\Controllers;

use App\User\v1\Http\Review\Requests\CreateReviewRequest;
use App\User\v1\Http\Review\Resources\ReviewResource;
use App\Http\Controllers\Controller;
use Domain\Review\Actions\User\CreateReviewAction;
use Domain\Review\DataTransferObjects\ReviewData;
use Domain\Review\Models\Review;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    public function store(CreateReviewRequest $request): JsonResponse
    {
        $this->authorize('create', app(Review::class));

        $review = CreateReviewAction::run(ReviewData::from($request));

        return $review
            ? $this->okResponse(ReviewResource::make($review))
            : $this->failedResponse();
    }
}
