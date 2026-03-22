<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Skill extends Model
{
    use HasUuids;

    protected $fillable = [
        'domain_id',
        'name',
        'label_es',
        'label_en',
    ];

    public function domain(): BelongsTo
    {
        return $this->belongsTo(SkillDomain::class, 'domain_id');
    }

    public function activities(): HasMany
    {
        return $this->hasMany(Activity::class);
    }

    public function masteryScores(): HasMany
    {
        return $this->hasMany(MasteryScore::class);
    }

    public function content(): HasOne
    {
        return $this->hasOne(SkillContent::class);
    }
}
