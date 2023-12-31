<?php

namespace App\Providers;

use Domain\Client\Managers\IManagers\IProviderManager;
use Domain\Client\Managers\Managers\ProviderManager;
use Domain\Client\Services\IServices\IProviderService;
use Domain\Payment\Actions\Stripe\ConfirmPaymentAction;
use Domain\Payment\Actions\Stripe\CreatePaymentAction;
use Domain\Payment\Actions\Stripe\GetPaymentAction;
use Domain\Payment\Managers\IManagers\IPaymentManager;
use Domain\Payment\Managers\Managers\PaymentManager;
use Domain\Product\Builders\Builders\ProductBuilder;
use Domain\Product\Builders\IBuilders\IProductBuilder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Shared\Enums\MorphEnum;
use Stripe\StripeClient;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IProviderManager::class, ProviderManager::class);
        $this->app->bind(IProductBuilder::class, ProductBuilder::class);
        $this->app->bind(IPaymentManager::class, PaymentManager::class);
        $this->app->bind(
            CreatePaymentAction::class,
            fn () => new CreatePaymentAction(new StripeClient(config('payment.stripe.secret_key')))
        );
        $this->app->bind(
            GetPaymentAction::class,
            fn () => new GetPaymentAction(new StripeClient(config('payment.stripe.secret_key')))
        );
        $this->app->bind(
            ConfirmPaymentAction::class,
            fn () => new ConfirmPaymentAction(new StripeClient(config('payment.stripe.secret_key')))
        );

        if ($this->app->environment('local')) {
            \DB::listen(function ($query) {
                \Log::info(
                    $query->sql,
                    $query->bindings,
                    $query->time
                );
            });
        }
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Model::shouldBeStrict(! $this->app->isProduction());

        Relation::morphMap([
            MorphEnum::USER->value => \Domain\Client\Models\User::class,
            MorphEnum::PRODUCT->value => \Domain\Product\Models\Product::class,
        ]);

        $this->loadMigrationsFrom([
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Client',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Category',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Brand',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Product',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Cart',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Order',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Payment',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Location',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Review',
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Favorite',
        ]);


        if ($this->app->isLocal()) {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
            $this->app->register(\Laravel\Telescope\TelescopeServiceProvider::class);
            $this->app->register(TelescopeServiceProvider::class);
        }

        Passport::tokensCan([
            'admin' => 'Admin can access the dashboard',
            'user' => 'user can access the web app',
        ]);

        Passport::setDefaultScope('user');
    }
}
