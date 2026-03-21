<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'student'  => \App\Http\Middleware\EnsureIsStudent::class,
            'teacher'  => \App\Http\Middleware\EnsureIsTeacher::class,
            'setlocale' => \App\Http\Middleware\SetLocale::class,
        ]);

        $middleware->api(append: [
            \App\Http\Middleware\SetLocale::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        // Standardize all API JSON error responses to {"error": {"code": "...", "message": "..."}}
        $exceptions->render(function (\Throwable $e, \Illuminate\Http\Request $request) {
            if (!$request->expectsJson() && !str_starts_with($request->path(), 'api/')) {
                return null; // Let default handler deal with web routes
            }

            if ($e instanceof \Illuminate\Auth\AuthenticationException) {
                return response()->json(['error' => ['code' => 'UNAUTHENTICATED', 'message' => 'Unauthenticated.']], 401);
            }

            if ($e instanceof \Illuminate\Auth\Access\AuthorizationException) {
                return response()->json(['error' => ['code' => 'FORBIDDEN', 'message' => 'This action is unauthorized.']], 403);
            }

            if ($e instanceof \Illuminate\Database\Eloquent\ModelNotFoundException) {
                return response()->json(['error' => ['code' => 'NOT_FOUND', 'message' => 'Resource not found.']], 404);
            }

            if ($e instanceof \Symfony\Component\HttpKernel\Exception\NotFoundHttpException) {
                return response()->json(['error' => ['code' => 'NOT_FOUND', 'message' => 'Endpoint not found.']], 404);
            }

            if ($e instanceof \Illuminate\Validation\ValidationException) {
                $first = collect($e->errors())->flatten()->first() ?? 'Validation failed.';
                return response()->json(['error' => ['code' => 'VALIDATION_ERROR', 'message' => $first, 'details' => $e->errors()]], 422);
            }

            if ($e instanceof \Symfony\Component\HttpKernel\Exception\HttpException) {
                return response()->json(['error' => ['code' => 'HTTP_ERROR', 'message' => $e->getMessage() ?: 'HTTP error.']], $e->getStatusCode());
            }

            return response()->json(['error' => ['code' => 'SERVER_ERROR', 'message' => 'An unexpected error occurred.']], 500);
        });
    })->create();

