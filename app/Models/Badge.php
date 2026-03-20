<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Badge extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description_es',
        'description_en',
        'icon_url',
        'trigger_type',
        'trigger_config',
    ];

    protected function casts(): array
    {
        return [
            'trigger_config' => 'array',
        ];
    }

    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'student_badges')
            ->withPivot('earned_at')
            ->withTimestamps();
    }

    public function studentBadges(): HasMany
    {
        return $this->hasMany(StudentBadge::class);
    }
}
