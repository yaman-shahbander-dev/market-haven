<?php

namespace Domain\Product\Models;

use Database\Factories\Product\ProductBrandFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;
use \Domain\Product\Models\Product;

class ProductBrand extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'product_brand';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'product_id',
        'brand_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): ProductBrandFactory
    {
        return ProductBrandFactory::new();
    }
}
