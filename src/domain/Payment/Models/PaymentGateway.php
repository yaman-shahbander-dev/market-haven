<?php

namespace Domain\Payment\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PaymentGateway extends Model
{
    use HasFactory, SoftDeletes;

    protected $table = 'payment_gateways';

    protected $fillable = [
        'name',
        'key',
        'disabled_at',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    protected $casts = [
        'confirmed_at' => 'datetime',
    ];
}
