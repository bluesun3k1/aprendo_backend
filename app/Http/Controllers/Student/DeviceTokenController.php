<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Models\DeviceToken;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class DeviceTokenController extends Controller
{
    // -----------------------------------------------------------------------
    // POST /api/v1/student/device-token
    // -----------------------------------------------------------------------
    public function store(Request $request): JsonResponse
    {
        $student = $request->user();

        $request->validate([
            'platform' => 'required|in:android,ios',
            'token'    => 'required|string',
        ]);

        DeviceToken::updateOrCreate(
            ['token' => $request->token],
            ['student_id' => $student->id, 'platform' => $request->platform]
        );

        return response()->json(['message' => 'Device token registered.'], 201);
    }
}
