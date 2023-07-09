<?php

namespace Domain\Cart\Models;

use Database\Factories\Cart\CartFactory;
use Domain\Client\Models\User;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;
use Shared\Traits\Uuid;

class Cart extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'carts';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'quantity',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): CartFactory
    {
        return CartFactory::new();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'cart_product');
    }

    public function productsWithDetails(): BelongsToMany
    {
        return $this->products()
            ->select([
                'products.id',
                'products.title',
                'products.description',
                'product_details.price AS product_price',
                'product_details.discount',
                'product_details.quantity AS product_quantity',
                'product_details.available',
                DB::raw('(
                        SELECT JSON_ARRAYAGG(JSON_OBJECT("id", id, "color", color, "quantity", quantity))
                        FROM product_colors
                        WHERE product_colors.product_detail_id = product_details.id
                     ) AS product_color_info'),
                DB::raw('GROUP_CONCAT(DISTINCT brands.name SEPARATOR ", ") AS product_brand_names'),
                DB::raw('GROUP_CONCAT(DISTINCT categories.name SEPARATOR ", ") AS product_category_names'),
            ])
            ->leftJoin('product_details', 'product_details.product_id', '=', 'products.id')
            ->leftJoin('product_colors', 'product_colors.product_detail_id', '=', 'product_details.id')
            ->leftJoin('product_brand', 'products.id', '=', 'product_brand.product_id')
            ->leftJoin('brands', 'product_brand.brand_id', '=', 'brands.id')
            ->leftJoin('product_category', 'product_category.product_id', '=', 'products.id')
            ->leftJoin('categories', 'categories.id', '=', 'product_category.category_id')
            ->groupBy([
                'products.id',
                'products.title',
                'products.description',
                'products.created_at',
                'products.updated_at',
                'products.deleted_at',
                'product_details.id',
                'product_details.price',
                'product_details.discount',
                'product_details.quantity',
                'product_details.available',
                'cart_product.cart_id'
            ]);
    }
}
