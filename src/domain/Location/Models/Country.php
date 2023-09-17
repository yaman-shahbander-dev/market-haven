<?php

namespace Domain\Location\Models;

use Database\Factories\Location\CountryFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class Country extends Model
{
    use Uuid;
    use SoftDeletes;

    protected $table = 'countries';

    protected $fillable = [
        'continent_id',
        'name',
        'full_name',
        'capital',
        'code',
        'code_alpha3',
        'emoji',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): CountryFactory
    {
        return CountryFactory::new();
    }

    public function continent(): BelongsTo
    {
        return $this->belongsTo(Continent::class);
    }

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }
}
