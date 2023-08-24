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
        if (Schema::hasTable('countries')) {
            Schema::table('countries', function (Blueprint $table) {
                $table->foreign('continent_id')->references('id')->on('continents');
            });
        }

        if (Schema::hasTable('cities')) {
            Schema::table('cities', function (Blueprint $table) {
                $table->foreign('country_id')->references('id')->on('countries');
            });
        }

        if (Schema::hasTable('addresses')) {
            Schema::table('addresses', function (Blueprint $table) {
                $table->foreign('city_id')->references('id')->on('cities');
                $table->foreign('order_id')->references('id')->on('orders');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropForeign('countries_continent_id_foreign');
        });

        Schema::table('cities', function (Blueprint $table) {
            $table->dropForeign('cities_country_id_foreign');
        });

        Schema::table('addresses', function (Blueprint $table) {
            $table->dropForeign('addresses_city_id_foreign');
            $table->dropForeign('addresses_order_id_foreign');
        });
    }
};
