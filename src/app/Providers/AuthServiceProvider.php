<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Domain\Brand\Models\Brand;
use Domain\Brand\Policies\BrandPolicy;
use Domain\Category\Models\Category;
use Domain\Category\Policies\CategoryPolicy;
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
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
    }
}
