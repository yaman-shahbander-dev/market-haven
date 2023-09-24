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
        Schema::create('reviews', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuidMorphs('reviewable');
            $table->foreignUuid('user_id');
            $table->unsignedSmallInteger('rating');
            $table->text('review');
            $table->timestamp('approved_at')->nullable();
            $table->timestamps();
            $table->primary('id');
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
