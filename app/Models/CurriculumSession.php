<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class CurriculumSession extends Model
{
    use HasUuids;

    protected $table = 'curriculum_sessions';

    protected $fillable = [
        'curriculum_unit_id',
        'code',
        'title_es',
        'title_en',
        'session_type',
        'sort_order',
        'estimated_minutes',
    ];

    protected function casts(): array
    {
        return [
            'sort_order'        => 'integer',
            'estimated_minutes' => 'integer',
        ];
    }

    public function unit(): BelongsTo
    {
        return $this->belongsTo(CurriculumUnit::class, 'curriculum_unit_id');
    }

    public function items(): HasMany
    {
        return $this->hasMany(CurriculumSessionItem::class)->orderBy('sort_order');
    }

    public function queueItems(): HasMany
    {
        return $this->hasMany(StudentSessionQueue::class, 'curriculum_session_id');
    }
}
