<?php

namespace Domain\Product\Models;

use Database\Factories\Product\ProductColorsFactory;
use Domain\Cart\Models\CartProduct;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;
use Domain\Product\Models\ProductDetail;

class ProductColor extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'product_colors';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'product_detail_id',
        'color',
        'quantity',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): ProductColorsFactory
    {
        return ProductColorsFactory::new();
    }

    public function productDetail(): BelongsTo
    {
        return $this->belongsTo(ProductDetail::class);
    }

    public function cartProducts(): HasMany
    {
        return $this->hasMany(CartProduct::class);
    }
}
