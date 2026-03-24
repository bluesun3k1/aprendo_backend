<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentSessionQueue extends Model
{
    use HasUuids;

    protected $table = 'student_session_queue';

    protected $fillable = [
        'student_id',
        'curriculum_session_id',
        'generated_session_id',
        'session_kind',
        'queue_order',
        'status',
        'available_at',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'queue_order'  => 'integer',
            'available_at' => 'datetime',
            'completed_at' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function curriculumSession(): BelongsTo
    {
        return $this->belongsTo(CurriculumSession::class, 'curriculum_session_id');
    }

    public function generatedSession(): BelongsTo
    {
        return $this->belongsTo(StudentSession::class, 'generated_session_id');
    }
}
