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
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
            'target'    => 'integer',
        ];
    }

    public function studentMissions(): HasMany
    {
        return $this->hasMany(StudentMission::class, 'mission_id');
    }
}
