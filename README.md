<p align="center">
  A <a href="https://laravel.com" target="_blank">Laravel</a> e-commerce project with a Domain-Driven Design (DDD) structure.
</p>

# Requirements
- PHP ^8.1
- Composer ^2.2

# Installed Packages

General:
- [Passport](https://laravel.com/docs/10.x/passport)
- [Laravel Actions](https://laravelactions.com)
- [Laravel Data](https://spatie.be/docs/laravel-data/v3/introduction)
- [Laravel Query Builder](https://spatie.be/index.php/docs/laravel-query-builder/v5/introduction)

Development:
- [Laravel IDE Helper](https://github.com/barryvdh/laravel-ide-helper)
- [Scribe API documentation tool](https://scribe.knuckles.wtf/laravel)
- [Laravel Telescope](https://laravel.com/docs/10.x/telescope)
- [Pest Testing Framework](https://pestphp.com/)
- [Grum PHP](https://github.com/phpro/grumphp)
- [Security Advisor](https://github.com/Roave/SecurityAdvisories)

# Features
- [DDD (Domain Driven Design)](#ddd)
- [API Response Helper](#api-response-helper)
- [Scribe Api Tags](#scribe-api-tags)
- [Global Helper](#global-helper)
- [Migration Structure](#migration-structure)
- [Polymorphic Mapping](#polymorphic-mapping)
- [Database Seeders](#database-seeders)
- [Shared Directory](#shared-directory)
- [Enable Model Strict Mode](https://laravel.com/docs/10.x/eloquent#configuring-eloquent-strictness)
- [Pest testing framework](https://pestphp.com/docs/installation)

## API Response Helper
A simple trait allowing consistent API responses throughout your Laravel application.

### Available methods:
| Method                    | Status |
|:--------------------------|:-------|
| `okResponse()`            | `200`  |
| `createdResponse()`       | `201`  |
| `failedResponse()`        | `400`  |
| `unauthorizedResponse()`  | `401`  |
| `forbiddenResponse()`     | `403`  |
| `notFoundResponse()`      | `404`  |
| `unprocessableResponse()` | `422`  |
| `serverErrorResponse()`   | `500`  |

## Scribe Api Tags
Additional scribe tags that match the ApiResponseHelper responses.

### Available Response tags:
| Tag                      | Status |
|:-------------------------|:-------|
| `@okResponse`            | `200`  |
| `@createdResponse`       | `201`  |
| `@failedResponse`        | `400`  |
| `@unauthorizedResponse`  | `401`  |
| `@forbiddenResponse`     | `403`  |
| `@notFoundResponse`      | `404`  |
| `@unprocessableResponse` | `422`  |
| `@serverErrorResponse`   | `500`  |

### Other Available tag:
| Tag               | Description                                                      |
|:------------------|:-----------------------------------------------------------------|
| `@usesPagination` | will add `page[number]` and `page[size]` to the query parameters |

## Global Helper
Simple php file that contains you global functions, which you can find it in `./src/shared/Helpers/global.php`.

## Migration Structure
In order to group your migration files by their domains, you can create additional migration directories
and load them in the `AppServiceProvider` using `loadMigrationsFrom` function:

```php
<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadMigrationsFrom([
            database_path().DIRECTORY_SEPARATOR.'migrations'.DIRECTORY_SEPARATOR.'Client',
        ]);
    }
}
```

## Shared Directory
The `src/shared/` directory is used for helper, traits, enums .... that are going to be used by the application and the domain.
