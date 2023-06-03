<?php

namespace Domain\Brand\Models;

use Database\Factories\Brand\BrandFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class Brand extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'brands';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): BrandFactory
    {
        return BrandFactory::new();
    }
}
