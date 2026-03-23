<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurriculumTrack extends Model
{
    use HasUuids;

    protected $table = 'curriculum_tracks';

    protected $fillable = [
        'grade_band_id',
        'code',
        'label_es',
        'label_en',
        'version',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function gradeBand(): BelongsTo
    {
        return $this->belongsTo(GradeBand::class);
    }

    public function units(): HasMany
    {
        return $this->hasMany(CurriculumUnit::class)->orderBy('sort_order');
    }

    public function studentTracks(): HasMany
    {
        return $this->hasMany(StudentCurriculumTrack::class);
    }
}
