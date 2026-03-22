<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SkillDomain extends Model
{
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'id',
        'label_es',
        'label_en',
    ];

    public function skills(): HasMany
    {
        return $this->hasMany(Skill::class, 'domain_id');
    }

    public function milestones(): HasMany
    {
        return $this->hasMany(DomainMilestone::class, 'domain_id')->orderBy('sort_order')->orderBy('threshold');
    }
}
