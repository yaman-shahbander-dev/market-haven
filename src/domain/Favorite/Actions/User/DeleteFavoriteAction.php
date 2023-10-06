<?php

namespace Domain\Favorite\Actions\User;

use App\Exceptions\DataNotFoundException;
use Domain\Favorite\Models\Favorite;
use Lorisleiva\Actions\Concerns\AsAction;
use Spatie\QueryBuilder\QueryBuilder;
use Domain\Favorite\DataTransferObjects\FavoriteData;

class DeleteFavoriteAction
{
    use AsAction;

    public function __construct(
        protected Favorite $favorite
    ) {
    }

    public function handle(FavoriteData $data): DataNotFoundException|bool
    {
        $favorite = QueryBuilder::for($this->favorite)
            ->where([
                'user_id' => $data->userId,
                'favorable_type' => $data->favorableType,
                'favorable_id' => $data->favorableId
            ])
            ->first();

        if (!$favorite) return throw new DataNotFoundException();

        return $favorite->delete();
    }
}
