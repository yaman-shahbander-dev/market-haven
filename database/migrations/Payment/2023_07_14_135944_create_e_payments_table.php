<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('e_payments', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedMediumInteger('gateway_id');
            $table->string('gateway_payment_id')->nullable();
            $table->string('gateway_client_payment_id')->nullable();
            $table->decimal('value', 60, 0);
            $table->string('currency', 5)->default('USD');
            $table->string('gateway_state', 50);
            $table->string('state', 50);
            $table->timestamp('confirmed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->primary('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('e_payments');
    }
};
