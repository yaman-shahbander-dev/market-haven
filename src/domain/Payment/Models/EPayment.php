<?php

namespace Domain\Payment\Models;

use Domain\Payment\States\PaymentState;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Shared\Traits\Uuid;
use Spatie\ModelStates\HasStates;

class EPayment extends Model
{
    use Uuid, HasFactory, SoftDeletes;
//    use Uuid, HasFactory, SoftDeletes, HasStates;

    protected $table = 'e_payments';

    protected $fillable = [
        'id',
        'gateway_id',
        'gateway_payment_id',
        'gateway_client_payment_id',
        'gateway_refund_id',
        'value',
        'currency',
        'gateway_state',
        'state',
        'confirmed_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'gateway_id' => 'integer',
        'value' => 'double',
//        'state' => PaymentState::class,
        'confirmed_at' => 'datetime',
    ];

}
