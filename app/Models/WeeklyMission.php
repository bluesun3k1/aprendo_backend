<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class WeeklyMission extends Model
{
    use HasUuids;

    protected $table = 'weekly_missions';

    protected $fillable = [
        'label_es',
        'label_en',
        'target',
        'mission_type',
        'is_active',
        'category',
        'domain_id',
        'grade_band',
        'reward_xp',
        'difficulty',
        'sort_order',
        'is_repeatable',
    ];

    protected function casts(): array
    {
        return [
            'is_active'    => 'boolean',
            'target'       => 'integer',
            'reward_xp'    => 'integer',
            'sort_order'   => 'integer',
            'is_repeatable' => 'boolean',
        ];
    }

    public function studentMissions(): HasMany
    {
        return $this->hasMany(StudentMission::class, 'mission_id');
    }
}
