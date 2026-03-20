<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProgressSnapshot extends Model
{
    use HasUuids;

    protected $table = 'progress_snapshots';

    protected $fillable = [
        'student_id',
        'domain_id',
        'skill_id',
        'mastery_score',
        'recorded_at',
    ];

    protected function casts(): array
    {
        return [
            'mastery_score' => 'integer',
            'recorded_at'   => 'date',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function domain(): BelongsTo
    {
        return $this->belongsTo(SkillDomain::class, 'domain_id');
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
