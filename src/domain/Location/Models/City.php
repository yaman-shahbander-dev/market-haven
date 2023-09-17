<?php

namespace Domain\Location\Models;

use Database\Factories\Location\CityFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class City extends Model
{
    use Uuid;
    use SoftDeletes;

    protected $table = 'cities';

    protected $fillable = [
        'country_id',
        'name',
        'full_name',
        'code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): CityFactory
    {
        return CityFactory::new();
    }

    public function country(): BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function addresses(): HasMany
    {
        return $this->hasMany(Address::class);
    }
}
