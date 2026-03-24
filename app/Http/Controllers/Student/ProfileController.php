<?php

namespace App\Http\Controllers\Student;

use App\Http\Controllers\Controller;
use App\Services\XpService;
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

        // When grade changes, recalculate the content band
        if (isset($data['grade'])) {
            $data['age_band']       = XpService::ageBandFromGrade($data['grade']);
            $data['placement_band'] = XpService::ageBandFromGrade($data['grade']);
        }

        $student->update($data);

        return response()->json([
            'id'             => $student->id,
            'display_name'   => $student->display_name,
            'grade'          => $student->grade,
            'age'            => $student->age,
            'age_band'       => $student->age_band,
            'placement_band' => $student->placement_band,
        ]);
    }
}
