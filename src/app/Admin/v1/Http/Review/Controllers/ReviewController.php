<?php

namespace App\Admin\v1\Http\Review\Controllers;

use App\Admin\v1\Http\Review\Resources\ReviewResource;
use App\Http\Controllers\Controller;
use Domain\Review\Actions\Admin\ApproveReviewAction;
use Domain\Review\Actions\Admin\DeleteReviewAction;
use Domain\Review\Actions\Admin\GetReviewsAction;
use Domain\Review\Actions\Admin\ShowReviewAction;
use Domain\Review\Models\Review;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    public function index(): JsonResponse
    {
        $this->authorize('view', app(Review::class));

        $reviews = GetReviewsAction::run();

        return ReviewResource::paginatedCollection($reviews);
    }

    public function show(Review $review): JsonResponse
    {
        $this->authorize('view', app(Review::class));

        $review = ShowReviewAction::run($review->id);

        return $review
            ? $this->okResponse(ReviewResource::make($review))
            : $this->notFoundResponse();
    }

    public function destroy(Review $review): JsonResponse
    {
        $this->authorize('delete', $review);

        $result = DeleteReviewAction::run($review->id);

        return $result
            ? $this->okResponse()
            : $this->notFoundResponse();
    }

    public function approve(Review $review): JsonResponse
    {
        $this->authorize('approve', $review);

        $result = ApproveReviewAction::run($review->id);

        return $result
            ? $this->okResponse()
            : $this->notFoundResponse();
    }
}
