<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Laravel\Sanctum\HasApiTokens;

class Student extends Model
{
    use HasFactory, HasUuids, HasApiTokens;

    protected $fillable = [
        'school_id',
        'display_name',
        'username',
        'pin',
        'grade',
        'age',
        'age_band',
        'placement_band',
        'avatar_url',
        'is_active',
        'diagnostic_completed',
        'points_total',
        'current_level',
        'current_xp',
    ];

    protected $hidden = [
        'pin',
    ];

    protected function casts(): array
    {
        return [
            'is_active'            => 'boolean',
            'diagnostic_completed' => 'boolean',
            'age'                  => 'integer',
            'points_total'         => 'integer',
            'current_level'        => 'integer',
            'current_xp'           => 'integer',
        ];
    }

    public function school(): BelongsTo
    {
        return $this->belongsTo(School::class);
    }

    public function masteryScores(): HasMany
    {
        return $this->hasMany(MasteryScore::class);
    }

    public function learningPath(): HasOne
    {
        return $this->hasOne(LearningPath::class);
    }

    public function streak(): HasOne
    {
        return $this->hasOne(Streak::class);
    }

    public function badges()
    {
        return $this->belongsToMany(Badge::class, 'student_badges')
            ->withPivot('earned_at')
            ->withTimestamps();
    }

    public function studentBadges(): HasMany
    {
        return $this->hasMany(StudentBadge::class);
    }

    public function studentMissions(): HasMany
    {
        return $this->hasMany(StudentMission::class);
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class);
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(StudentSession::class);
    }

    public function progressSnapshots(): HasMany
    {
        return $this->hasMany(ProgressSnapshot::class);
    }
}
