<?php

namespace Domain\Favorite\Models;

use Database\Factories\Favorite\FavoriteFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Shared\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Favorite extends Model
{
    use Uuid;
    use SoftDeletes;
    use HasFactory;

    protected $table = 'favorites';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'favorable_type',
        'favorable_id',
        'user_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): FavoriteFactory
    {
        return FavoriteFactory::new();
    }

    public function favorable(): MorphTo
    {
        return $this->morphTo();
    }
}
