<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Auth\Middleware\Authenticate;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->web(append: [
            \App\Http\Middleware\TrackVisitors::class,
        ]);

        // When an unauthenticated user visits, redirect based on path.
        Authenticate::redirectUsing(function (Request $request): string {
            if ($request->is('portal') || $request->is('portal/*')) {
                return url('/portal/login');
            }
            return url('/admin/login');
        });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->renderable(function (AuthenticationException $e, Request $request) {
            if (!$request->expectsJson()) {
                if ($request->is('portal') || $request->is('portal/*')) {
                    return redirect()->guest(url('/portal/login'));
                }
                return redirect()->guest(url('/admin/login'));
            }
        });
    })->create();

