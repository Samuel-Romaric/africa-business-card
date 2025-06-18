<?php

use App\Http\Middleware\GlobalAdmin;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->group('web', [
            \Illuminate\Cookie\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \Illuminate\Foundation\Http\Middleware\ValidateCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
            \Illuminate\Session\Middleware\AuthenticateSession::class,
            // \App\Http\Middleware\GlobalAdmin::class,
        ]);
        //
        $middleware->redirectGuestsTo('/login');
        
        // Using a closure...
        $middleware->redirectGuestsTo(fn (Request $request) => route('admin.login'));

        $middleware->append(GlobalAdmin::class);
        $middleware->alias(['isGlobalAdmin' => GlobalAdmin::class]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
