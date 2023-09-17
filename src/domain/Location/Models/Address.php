<?php

namespace Domain\Location\Models;

use Database\Factories\Location\AddressFactory;
use Domain\Order\Models\Order;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;

class Address extends Model
{
    use Uuid;
    use SoftDeletes;

    protected $table = 'addresses';

    protected $fillable = [
        'city_id',
        'order_id',
        'address',
        'postal_code',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected static function newFactory(): AddressFactory
    {
        return AddressFactory::new();
    }

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function order(): BelongsTo
    {
        return $this->belongsTo(Order::class);
    }
}
