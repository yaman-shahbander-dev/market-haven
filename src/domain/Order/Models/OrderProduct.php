<?php

namespace Domain\Order\Models;

use Database\Factories\Order\OrderProductFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class OrderProduct extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'order_product';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'product_id',
        'order_id',
        'quantity',
        'price',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): OrderProductFactory
    {
        return OrderProductFactory::new();
    }
}
