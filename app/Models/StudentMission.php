<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentMission extends Model
{
    use HasUuids;

    protected $table = 'student_missions';

    protected $fillable = [
        'student_id',
        'mission_id',
        'week_start',
        'progress',
        'completed',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'completed'    => 'boolean',
            'progress'     => 'integer',
            'week_start'   => 'date',
            'completed_at' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function mission(): BelongsTo
    {
        return $this->belongsTo(WeeklyMission::class, 'mission_id');
    }
}
