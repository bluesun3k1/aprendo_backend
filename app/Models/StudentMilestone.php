<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StudentMilestone extends Model
{
    protected $fillable = [
        'student_id',
        'milestone_id',
        'unlocked_at',
        'source_domain_score',
        'meta',
    ];

    protected function casts(): array
    {
        return [
            'unlocked_at'         => 'datetime',
            'source_domain_score' => 'integer',
            'meta'                => 'array',
        ];
    }

    public function milestone(): BelongsTo
    {
        return $this->belongsTo(DomainMilestone::class, 'milestone_id');
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
