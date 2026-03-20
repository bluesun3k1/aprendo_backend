<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MasteryScore extends Model
{
    use HasUuids;

    protected $fillable = [
        'student_id',
        'skill_id',
        'score',
        'trend',
        'last_practiced_at',
    ];

    protected function casts(): array
    {
        return [
            'score'             => 'integer',
            'last_practiced_at' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
