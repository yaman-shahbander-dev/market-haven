<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Seeders\Brand\BrandSeeder;
use Database\Seeders\Cart\CartProductSeeder;
use Database\Seeders\Cart\CartSeeder;
use Database\Seeders\Category\CategorySeeder;
use Database\Seeders\Client\AdminPermissionSeeder;
use Database\Seeders\Client\PermissionSeeder;
use Database\Seeders\Client\RolePermissionSeeder;
use Database\Seeders\Client\UserPermissionSeeder;
use Database\Seeders\Client\UserSeeder;
use Database\Seeders\Order\OrderProductSeeder;
use Database\Seeders\Order\OrderSeeder;
use Database\Seeders\Payment\GatewaySeeder;
use Database\Seeders\Product\ProductBrandSeeder;
use Database\Seeders\Product\ProductCategorySeeder;
use Database\Seeders\Product\ProductColorsSeeder;
use Database\Seeders\Product\ProductDetailsSeeder;
use Database\Seeders\Product\ProductSeeder;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /*
    |--------------------------------------------------------------------------
    | Seeding Strategy
    |--------------------------------------------------------------------------
    |
    | In order to maintain your seeders working even after production, try to check for seeded data
    | existence in the database before seeding it. This can help you in development to avoid
    | a database refreshing when seeding new data and will also prevent duplicated data.
    |
    */

    public function run(): void
    {
        // production seeders.
        $seeders = [
            UserSeeder::class,
            CategorySeeder::class,
            PermissionSeeder::class,
            RolePermissionSeeder::class,
            AdminPermissionSeeder::class,
            UserPermissionSeeder::class,
            BrandSeeder::class,
            ProductSeeder::class,
            ProductDetailsSeeder::class,
            ProductColorsSeeder::class,
            ProductBrandSeeder::class,
            ProductCategorySeeder::class,
            CartSeeder::class,
            CartProductSeeder::class,
            OrderSeeder::class,
            OrderProductSeeder::class,
            GatewaySeeder::class,
        ];

        /*
        |--------------------------------------------------------------------------
        | Disable ForeignKey Constraints
        |--------------------------------------------------------------------------
        |
        | Disabling foreign key constraints give flexibility to your testing seeders, but
        | it may result data inconsistency. so be careful if you decide to disable them.
        |
        */
        if (app()->environment(['local', 'staging', 'testing'])) {
            Schema::disableForeignKeyConstraints();
            $this->call($seeders);
            Schema::enableForeignKeyConstraints();
        }
    }
}
