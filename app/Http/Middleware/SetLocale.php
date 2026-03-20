<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $lang = $request->header('Accept-Language', 'es');
        $locale = in_array($lang, ['es', 'en']) ? $lang : 'es';
        app()->setLocale($locale);

        return $next($request);
    }
}
