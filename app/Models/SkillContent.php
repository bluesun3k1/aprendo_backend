<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SkillContent extends Model
{
    protected $fillable = [
        'skill_id',
        'description',
        'why_it_matters',
        'doing_well_high',
        'doing_well_low',
        'practice_next_high',
        'practice_next_low',
        'insight_tip',
        'insight_tip_body',
        'insight_example',
    ];

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
