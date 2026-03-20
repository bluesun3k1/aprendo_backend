<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureIsTeacher
{
    public function handle(Request $request, Closure $next): Response
    {
        if (! ($request->user() instanceof User)) {
            return response()->json(['message' => 'Unauthorized.'], 403);
        }

        if (! $request->user()->is_active) {
            return response()->json(['message' => 'Account inactive.'], 403);
        }

        return $next($request);
    }
}
