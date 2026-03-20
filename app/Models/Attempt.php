<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Attempt extends Model
{
    use HasUuids;

    protected $fillable = [
        'student_id',
        'session_id',
        'activity_id',
        'response',
        'correct',
        'score_delta',
        'feedback_text',
        'response_time_ms',
        'hints_used',
        'completed',
        'client_timestamp',
    ];

    protected function casts(): array
    {
        return [
            'response'         => 'array',
            'correct'          => 'boolean',
            'completed'        => 'boolean',
            'client_timestamp' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(StudentSession::class, 'session_id');
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
