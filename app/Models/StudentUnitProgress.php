<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentUnitProgress extends Model
{
    use HasUuids;

    protected $table = 'student_unit_progress';

    protected $fillable = [
        'student_id',
        'curriculum_unit_id',
        'status',
        'started_at',
        'completed_at',
        'mastery_snapshot',
    ];

    protected function casts(): array
    {
        return [
            'started_at'       => 'datetime',
            'completed_at'     => 'datetime',
            'mastery_snapshot' => 'array',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(CurriculumUnit::class, 'curriculum_unit_id');
    }
}
