<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurriculumUnitSkill extends Model
{
    use HasUuids;

    protected $table = 'curriculum_unit_skills';

    protected $fillable = [
        'curriculum_unit_id',
        'skill_id',
        'priority_weight',
        'target_mastery_min',
        'target_mastery_goal',
    ];

    protected function casts(): array
    {
        return [
            'priority_weight'     => 'integer',
            'target_mastery_min'  => 'integer',
            'target_mastery_goal' => 'integer',
        ];
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(CurriculumUnit::class, 'curriculum_unit_id');
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
