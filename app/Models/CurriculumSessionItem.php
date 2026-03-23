<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CurriculumSessionItem extends Model
{
    use HasUuids;

    protected $table = 'curriculum_session_items';

    protected $fillable = [
        'curriculum_session_id',
        'skill_id',
        'activity_type',
        'difficulty_min',
        'difficulty_max',
        'item_count',
        'selection_rule',
        'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'difficulty_min' => 'integer',
            'difficulty_max' => 'integer',
            'item_count'     => 'integer',
            'sort_order'     => 'integer',
        ];
    }

    public function session(): BelongsTo
    {
        return $this->belongsTo(CurriculumSession::class, 'curriculum_session_id');
    }

    public function skill(): BelongsTo
    {
        return $this->belongsTo(Skill::class);
    }
}
