<?php

namespace Domain\Favorite\Actions\User;

use Domain\Favorite\Models\Favorite;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;
use Domain\Favorite\DataTransferObjects\FavoriteData;

class AddFavoriteAction
{
    use AsAction;

    public function __construct(
        protected Favorite $favorite
    ) {
    }

    public function handle(FavoriteData $data): ?FavoriteData
    {
        $favorite = QueryBuilder::for($this->favorite)
            ->create([
                'user_id' => $data->userId,
                'favorable_type' => $data->favorableType,
                'favorable_id' => $data->favorableId,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

        return $favorite ? FavoriteData::from($favorite) : null;
    }
}
