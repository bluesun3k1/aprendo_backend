<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Activity extends Model
{
    use HasUuids;

    protected $fillable = [
        'skill_id',
        'type',
        'difficulty',
        'instructions_es',
        'instructions_en',
        'duration_seconds',
        'content',
        'correct_answer',
        'is_diagnostic',
        'is_active',
    ];

    protected function casts(): array
    {
        return [
            'content'       => 'array',
            'correct_answer' => 'array',
            'is_diagnostic' => 'boolean',
            'is_active'     => 'boolean',
            'difficulty'    => 'integer',
        ];
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
