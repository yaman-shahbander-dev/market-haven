<?php

namespace Domain\Order\Models;

use Database\Factories\Order\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class Order extends Model
{
    use HasFactory;
    use Uuid;
    use SoftDeletes;

    protected $table = 'orders';


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'state',
        'price',
        'expired_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }
}
