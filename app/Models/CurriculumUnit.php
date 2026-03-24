<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurriculumUnit extends Model
{
    use HasUuids;

    protected $table = 'curriculum_units';

    protected $fillable = [
        'curriculum_track_id',
        'code',
        'title_es',
        'title_en',
        'description_es',
        'description_en',
        'sort_order',
        'estimated_sessions',
        'mastery_threshold',
    ];

    protected function casts(): array
    {
        return [
            'sort_order'         => 'integer',
            'estimated_sessions' => 'integer',
            'mastery_threshold'  => 'integer',
        ];
    }

    public function track(): BelongsTo
    {
        return $this->belongsTo(CurriculumTrack::class, 'curriculum_track_id');
    }

    public function unitSkills(): HasMany
    {
        return $this->hasMany(CurriculumUnitSkill::class);
    }

    public function skills(): BelongsToMany
    {
        return $this->belongsToMany(Skill::class, 'curriculum_unit_skills')
                    ->withPivot('priority_weight', 'target_mastery_min', 'target_mastery_goal');
    }

    public function sessions(): HasMany
    {
        return $this->hasMany(CurriculumSession::class)->orderBy('sort_order');
    }

    public function studentProgress(): HasMany
    {
        return $this->hasMany(StudentUnitProgress::class, 'curriculum_unit_id');
    }
}
