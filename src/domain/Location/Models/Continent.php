<?php

namespace Domain\Location\Models;

use Database\Factories\Location\ContinentFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class Continent extends Model
{
    use Uuid;
    use SoftDeletes;

    protected $table = 'continents';

    protected $fillable = [
        'name',
        'code',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected static function newFactory(): ContinentFactory
    {
        return ContinentFactory::new();
    }
}
