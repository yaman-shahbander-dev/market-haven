<?php

namespace Domain\Cart\Models;

use Database\Factories\Cart\CartProductFactory;
use Domain\Product\Models\Product;
use Domain\Product\Models\ProductColor;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class CartProduct extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'cart_product';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'product_id',
        'product_color_id',
        'cart_id',
        'quantity',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): CartProductFactory
    {
        return CartProductFactory::new();
    }

    public function cart(): BelongsTo
    {
        return $this->belongsTo(Cart::class);
    }

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function productColor(): BelongsTo
    {
        return $this->belongsTo(ProductColor::class);
    }
}
