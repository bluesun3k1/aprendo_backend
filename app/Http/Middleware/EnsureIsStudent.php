<?php

namespace App\Http\Middleware;

use App\Models\Student;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsStudent
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! ($request->user() instanceof Student)) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        if (! $request->user()->is_active) {
            return response()->json(['message' => 'Account inactive.'], 403);
        }

        return $next($request);
    }
}
