<?php

namespace Domain\Order\Models;

use Database\Factories\Order\OrderFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;
use Domain\Payment\Enums\PaymentGatewayEnum;

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
        'no',
        'user_id',
        'first_name',
        'last_name',
        'email',
        'payment_gateway',
        'price',
        'state',
        'expired_at',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected array $enumCasts = [
        'payment_gateway' => PaymentGatewayEnum::class,
    ];

    protected $casts = [
        'price' => 'double',
//        'state' => OrderState::class,
        'no' => 'integer',
        'expired_at' => 'datetime',
    ];

    protected static function newFactory(): OrderFactory
    {
        return OrderFactory::new();
    }

    public function setSerialNumber(): void
    {
        $this->no = $this->query()->max('no') + 1;
    }
}
