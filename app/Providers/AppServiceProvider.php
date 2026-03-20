<?php

namespace App\Providers;

use Illuminate\Database\Schema\Builder;
use Illuminate\Support\ServiceProvider;
use Laravel\Sanctum\PersonalAccessToken;
use Laravel\Sanctum\Sanctum;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        // Fix for MySQL < 5.7.7 or MariaDB < 10.2 key length limitation
        Builder::defaultStringLength(191);

        // Allow Sanctum tokens to resolve to both User and Student models.
        Sanctum::authenticateAccessTokensUsing(
            static function (PersonalAccessToken $accessToken, bool $isValid) {
                return $isValid ? $accessToken->tokenable : null;
            }
        );
    }
}
