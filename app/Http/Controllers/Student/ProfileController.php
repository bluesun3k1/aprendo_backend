<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    // -----------------------------------------------------------------------
    // PATCH /api/v1/student/profile
    // -----------------------------------------------------------------------
    public function update(Request $request): JsonResponse
    {
        $student = $request->user();

        $data = $request->validate([
            'grade' => 'sometimes|string|max:20',
            'age'   => 'sometimes|integer|min:4|max:20',
        ]);

        $student->update($data);

        return response()->json([
            'id'           => $student->id,
            'display_name' => $student->display_name,
            'grade'        => $student->grade,
            'age'          => $student->age,
        ]);
    }
}
