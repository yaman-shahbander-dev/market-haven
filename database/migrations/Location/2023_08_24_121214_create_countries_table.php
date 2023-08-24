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
        Schema::create('countries', function (Blueprint $table) {
            $table->unsignedSmallInteger('id')->primary();
            $table->unsignedSmallInteger('continent_id');
            $table->string('name');
            $table->string('full_name')->nullable();
            $table->string('capital')->nullable();
            $table->string('code', 4)->nullable();
            $table->string('code_alpha3', 6)->nullable();
            $table->string('emoji', 16)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('countries');
    }
};
