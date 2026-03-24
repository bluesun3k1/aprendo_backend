<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\School;
use App\Models\Student;
use App\Models\User;
use App\Services\PlacementService;
use App\Services\XpService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    // -----------------------------------------------------------------------
    // POST /api/v1/auth/student/login
    // -----------------------------------------------------------------------
    public function studentLogin(Request $request): JsonResponse
    {
        $data = $request->validate([
            'school_code' => 'required|string',
            'username'    => 'required|string',
            'pin'         => 'required|string',
        ]);

        $school = School::where('school_code', $data['school_code'])->first();

        if (!$school) {
            return response()->json(['error' => ['code' => 'INVALID_CREDENTIALS', 'message' => 'Invalid credentials.']], 401);
        }

        $student = Student::where('school_id', $school->id)
            ->where('username', $data['username'])
            ->first();

        if (!$student || !Hash::check($data['pin'], $student->pin)) {
            return response()->json(['error' => ['code' => 'INVALID_CREDENTIALS', 'message' => 'Invalid credentials.']], 401);
        }

        if (!$student->is_active) {
            return response()->json(['error' => ['code' => 'ACCOUNT_INACTIVE', 'message' => 'Account inactive.']], 403);
        }

        $token    = $student->createToken('student-token')->plainTextToken;
        $ageBand  = $student->age_band ?? XpService::ageBandFromGrade($student->grade);

        // Bootstrap placement_band on first login if not yet set
        if ($student->placement_band === null) {
            $student->placement_band = XpService::ageBandFromGrade($student->grade);
            $student->save();
        }

        // Ensure the student has a curriculum track and active queue
        app(PlacementService::class)->ensureTrackAssigned($student->fresh());

        return response()->json([
            'token'   => $token,
            'student' => [
                'id'                   => $student->id,
                'display_name'         => $student->display_name,
                'grade'                => $student->grade,
                'age_band'             => $ageBand,
                'placement_band'       => $student->placement_band,
                'age'                  => $student->age,
                'school_id'            => $school->id,
                'school_name'          => $school->name,
                'diagnostic_completed' => $student->diagnostic_completed,
                'avatar_url'           => $student->avatar_url,
            ],
        ]);
    }

    // -----------------------------------------------------------------------
    // POST /api/v1/auth/login  (teacher / admin)
    // -----------------------------------------------------------------------
    public function login(Request $request): JsonResponse
    {
        $data = $request->validate([
            'email'    => 'required|email',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $data['email'])->first();

        if (!$user || !Hash::check($data['password'], $user->password)) {
            return response()->json(['error' => ['code' => 'INVALID_CREDENTIALS', 'message' => 'Invalid credentials.']], 401);
        }

        if (!$user->is_active) {
            return response()->json(['error' => ['code' => 'ACCOUNT_INACTIVE', 'message' => 'Account inactive.']], 403);
        }

        $token = $user->createToken('user-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'user'  => [
                'id'        => $user->id,
                'name'      => $user->name,
                'email'     => $user->email,
                'role'      => $user->role,
                'school_id' => $user->school_id,
            ],
        ]);
    }

    // -----------------------------------------------------------------------
    // POST /api/v1/auth/logout
    // -----------------------------------------------------------------------
    public function logout(Request $request): JsonResponse
    {
        $request->user()->currentAccessToken()->delete();

        return response()->json([]);
    }
}
