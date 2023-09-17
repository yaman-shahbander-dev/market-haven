<?php

namespace Domain\Category\Models;

use Database\Factories\Category\CategoryFactory;
use Domain\Product\Models\Product;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class Category extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'categories';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'main_category_id',
        'name',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory()
    {
        return CategoryFactory::new();
    }

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'product_category')
            ->using(new class extends Pivot {
                use Uuid;
            });
    }
}
