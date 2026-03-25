<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DomainMilestone extends Model
{
    protected $fillable = [
        'domain_id',
        'threshold',
        'name',
        'description',
        'sort_order',
        'icon',
        'reward_xp',
        'celebration_level',
        'is_hidden',
    ];

    protected function casts(): array
    {
        return [
            'threshold'         => 'integer',
            'sort_order'        => 'integer',
            'reward_xp'         => 'integer',
            'is_hidden'         => 'boolean',
        ];
    }

    public function domain(): BelongsTo
    {
        return $this->belongsTo(SkillDomain::class, 'domain_id');
    }
}
