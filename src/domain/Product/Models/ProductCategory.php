<?php

namespace Domain\Product\Models;

use Database\Factories\Product\ProductCategoryFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class ProductCategory extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'product_category';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'product_id',
        'category_id',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): ProductCategoryFactory
    {
        return ProductCategoryFactory::new();
    }
}
