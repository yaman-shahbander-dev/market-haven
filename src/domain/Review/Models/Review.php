<?php

namespace Domain\Review\Models;

use Database\Factories\Review\ReviewFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Shared\Traits\Uuid;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use Uuid;
    use SoftDeletes;
    use HasFactory;

    protected $table = 'reviews';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'reviewable_type',
        'reviewable_id',
        'user_id',
        'rating',
        'review',
        'approved_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): ReviewFactory
    {
        return ReviewFactory::new();
    }

    public function reviewable(): MorphTo
    {
        return $this->morphTo();
    }
}
