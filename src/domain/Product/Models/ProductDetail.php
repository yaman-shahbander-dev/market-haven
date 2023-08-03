<?php

namespace Domain\Product\Models;

use Database\Factories\Product\ProductDetailsFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;
use Domain\Product\Models\Product;
use Domain\Product\Models\ProductColor;

class ProductDetail extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'product_details';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'product_id',
        'price',
        'discount',
        'quantity',
        'available',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): ProductDetailsFactory
    {
        return ProductDetailsFactory::new();
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productColors(): HasMany
    {
        return $this->hasMany(ProductColor::class);
    }
}
