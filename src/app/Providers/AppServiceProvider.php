<?php

namespace App\Providers;

use Domain\Client\Managers\IManagers\IProviderManager;
use Domain\Client\Managers\Managers\ProviderManager;
use Domain\Client\Services\IServices\IProviderService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Passport;
use Shared\Enums\MorphEnum;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(IProviderManager::class, ProviderManager::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

        Model::shouldBeStrict(! $this->app->isProduction());

        Relation::morphMap([
            MorphEnum::USER->value => \Domain\Client\Models\User::class,
        ]);

        $this->loadMigrationsFrom([
            database_path() . DIRECTORY_SEPARATOR . 'migrations' . DIRECTORY_SEPARATOR . 'Client',
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
