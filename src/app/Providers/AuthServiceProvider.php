<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Domain\Brand\Models\Brand;
use Domain\Brand\Policies\BrandPolicy;
use Domain\Cart\Models\Cart;
use Domain\Cart\Policies\CartPolicy;
use Domain\Category\Models\Category;
use Domain\Category\Policies\CategoryPolicy;
use Domain\Location\Models\Address;
use Domain\Location\Models\City;
use Domain\Location\Models\Continent;
use Domain\Location\Models\Country;
use Domain\Location\Policies\AddressPolicy;
use Domain\Location\Policies\CityPolicy;
use Domain\Location\Policies\ContinentPolicy;
use Domain\Location\Policies\CountryPolicy;
use Domain\Order\Models\Order;
use Domain\Order\Policies\OrderPolicy;
use Domain\Product\Models\Product;
use Domain\Product\Policies\ProductPolicy;
use Domain\Review\Models\Review;
use Domain\Review\Policies\ReviewPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Category::class => CategoryPolicy::class,
        Brand::class => BrandPolicy::class,
        Product::class => ProductPolicy::class,
        Cart::class => CartPolicy::class,
        Order::class => OrderPolicy::class,
        Continent::class => ContinentPolicy::class,
        Country::class => CountryPolicy::class,
        City::class => CityPolicy::class,
        Address::class => AddressPolicy::class,
        Review::class => ReviewPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
    }
}
