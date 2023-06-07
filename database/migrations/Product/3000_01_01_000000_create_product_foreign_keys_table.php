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
        if (Schema::hasTable('product_details')) {
            Schema::table('product_details', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products');
            });
        }

        if (Schema::hasTable('product_colors')) {
            Schema::table('product_colors', function (Blueprint $table) {
                $table->foreign('product_detail_id')->references('id')->on('product_details');
            });
        }

        if (Schema::hasTable('product_brand')) {
            Schema::table('product_brand', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products');
                $table->foreign('brand_id')->references('id')->on('brands');
            });
        }

        if (Schema::hasTable('product_category')) {
            Schema::table('product_category', function (Blueprint $table) {
                $table->foreign('product_id')->references('id')->on('products');
                $table->foreign('category_id')->references('id')->on('categories');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_details', function (Blueprint $table) {
           $table->dropForeign('product_details_product_id_foreign');
        });

        Schema::table('product_colors', function (Blueprint $table) {
            $table->dropForeign('product_colors_product_detail_id_foreign');
        });

        Schema::table('product_brand', function (Blueprint $table) {
            $table->dropForeign('product_brand_product_id_foreign');
            $table->dropForeign('product_brand_brand_id_foreign');
        });

        Schema::table('product_category', function (Blueprint $table) {
            $table->dropForeign('product_category_product_id_foreign');
            $table->dropForeign('product_category_category_id_foreign');
        });
    }
};
