<?php

namespace App\Providers;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * The path to the "home" route for your application.
     *
     * Typically, users are redirected here after authentication.
     *
     * @var string
     */
    public const HOME = '/home';

    /**
     * Define your route model bindings, pattern filters, and other route configuration.
     */
    public function boot(): void
    {
        $this->configureRateLimiting();

        $this->routes(function (): void {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));

            Route::middleware('web')
                ->group(base_path('routes/web.php'));

            Route::middleware('bindings')->group(function () {

                Route::middleware('api')->prefix(config('route-prefix.admin.v1.prefix', 'admin/v1'))
                    ->group(function () {
                        Route::middleware('api')->group(function () {
                            Route::prefix(config('route-prefix.admin.v1.client', 'client'))
                                ->group(base_path('routes/admin/v1/client.php'));
                        });

                        Route::middleware('auth:api')->group(function () {
                            Route::prefix(config('route-prefix.admin.v1.category', 'category'))
                                ->group(base_path('routes/admin/v1/category.php'));

                            Route::prefix(config('route-prefix.admin.v1.brand', 'brand'))
                                ->group(base_path('routes/admin/v1/brand.php'));

                            Route::prefix(config('route-prefix.admin.v1.product', 'product'))
                                ->group(base_path('routes/admin/v1/product.php'));

                            Route::prefix(config('route-prefix.admin.v1.cart', 'cart'))
                                ->group(base_path('routes/admin/v1/cart.php'));

                            Route::prefix(config('route-prefix.admin.v1.location', 'location'))
                                ->group(base_path('routes/admin/v1/location.php'));

                            Route::prefix(config('route-prefix.admin.v1.review', 'review'))
                                ->group(base_path('routes/admin/v1/review.php'));
                        });
                    });

                Route::prefix(config('route-prefix.user.v1.prefix', 'user/v1'))
                    ->group(function () {
                        Route::middleware('api')->group(function () {
                            Route::prefix(config('route-prefix.user.v1.client', 'client'))
                                ->group(base_path('routes/user/v1/client.php'));
                        });

                        Route::middleware('auth:api')->group(function () {
                            Route::prefix(config('route-prefix.user.v1.category', 'category'))
                                ->group(base_path('routes/user/v1/category.php'));

                            Route::prefix(config('route-prefix.user.v1.brand', 'brand'))
                                ->group(base_path('routes/user/v1/brand.php'));

                            Route::prefix(config('route-prefix.user.v1.product', 'product'))
                                ->group(base_path('routes/user/v1/product.php'));

                            Route::prefix(config('route-prefix.user.v1.cart', 'cart'))
                                ->group(base_path('routes/user/v1/cart.php'));

                            Route::prefix(config('route-prefix.user.v1.order', 'order'))
                                ->group(base_path('routes/user/v1/order.php'));

                            Route::prefix(config('route-prefix.user.v1.location', 'location'))
                                ->group(base_path('routes/user/v1/location.php'));

                            Route::prefix(config('route-prefix.user.v1.review', 'review'))
                                ->group(base_path('routes/user/v1/review.php'));

                            Route::prefix(config('route-prefix.user.v1.favorite', 'favorite'))
                                ->group(base_path('routes/user/v1/favorite.php'));
                        });
                    });
            });
        });
    }

    /**
     * Configure the rate limiters for the application.
     */
    protected function configureRateLimiting(): void
    {
        RateLimiter::for('api', function (Request $request) {
            return Limit::perMinute(60)->by($request->user()?->id ?: $request->ip());
        });
    }
}
