<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GradeBand extends Model
{
    use HasUuids;

    protected $table = 'grade_bands';

    protected $fillable = [
        'code',
        'label_es',
        'label_en',
        'min_grade',
        'max_grade',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'min_grade'  => 'integer',
            'max_grade'  => 'integer',
            'sort_order' => 'integer',
        ];
    }

    public function tracks(): HasMany
    {
        return $this->hasMany(CurriculumTrack::class);
    }
}
