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
        Schema::create('orders', function (Blueprint $table) {
            $table->uuid('id');
            $table->unsignedBigInteger('no')->unique();
            $table->foreignUuid('user_id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email');
            $table->string('payment_gateway')->nullable();
            $table->decimal('price', 15, 2)->default(0.0);
            $table->string('state');//->default(Pending::getMorphClass());
            $table->timestamp('expired_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
