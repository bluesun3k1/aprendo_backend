<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StudentSession extends Model
{
    protected $table = 'student_sessions';

    use HasUuids;

    protected $fillable = [
        'student_id',
        'learning_path_id',
        'status',
        'estimated_duration_minutes',
        'domains',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'domains'      => 'array',
            'completed_at' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function learningPath(): BelongsTo
    {
        return $this->belongsTo(LearningPath::class);
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'session_activities')
            ->withPivot('order_index')
            ->orderBy('session_activities.order_index');
    }

    public function sessionActivities(): HasMany
    {
        return $this->hasMany(SessionActivity::class, 'session_id');
    }

    public function attempts(): HasMany
    {
        return $this->hasMany(Attempt::class, 'session_id');
    }
}
