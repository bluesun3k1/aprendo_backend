<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentCurriculumTrack extends Model
{
    use HasUuids;

    protected $table = 'student_curriculum_tracks';

    protected $fillable = [
        'student_id',
        'curriculum_track_id',
        'status',
        'started_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'started_at'   => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function track(): BelongsTo
    {
        return $this->belongsTo(CurriculumTrack::class, 'curriculum_track_id');
    }
}
