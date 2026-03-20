<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class StudentController extends Controller
{
    // -----------------------------------------------------------------------
    // POST /api/v1/teacher/students/{student_id}/reset-pin
    // -----------------------------------------------------------------------
    public function resetPin(Request $request, string $studentId): JsonResponse
    {
        $teacher = $request->user();

        $request->validate([
            'new_pin' => 'required|string|min:4|max:10',
        ]);

        $student = Student::where('id', $studentId)
            ->where('school_id', $teacher->school_id)
            ->firstOrFail();

        $student->update(['pin' => Hash::make($request->new_pin)]);

        return response()->json(['message' => 'PIN reset successfully.']);
    }
}
