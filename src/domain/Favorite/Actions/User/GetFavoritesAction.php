<?php

namespace Domain\Favorite\Actions\User;

use Domain\Favorite\Models\Favorite;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\LaravelData\PaginatedDataCollection;
use Spatie\QueryBuilder\QueryBuilder;
use Domain\Favorite\DataTransferObjects\FavoriteData;

class GetFavoritesAction
{
    use AsAction;

    public function __construct(
        protected Favorite $favorite
    ) {
    }

    public function handle(): ?PaginatedDataCollection
    {
        $favorites = QueryBuilder::for($this->favorite)
            ->where('user_id', auth()->user()->id)
            ->paginate();

        return $favorites ? FavoriteData::collection($favorites) : null;
    }
}
