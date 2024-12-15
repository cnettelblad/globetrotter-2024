<?php

namespace App\Providers;

use App\Macros\StrReverse;
use App\Services\DiscordService;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(DiscordService::class, function () {
            return new DiscordService(config('services.discord.token'));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        $this->registerMacros();
    }

    public function registerMacros(): void
    {
        Str::macro('reverseTwo', new StrReverse);
    }
}
