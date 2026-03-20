<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Streak extends Model
{
    use HasUuids;

    protected $fillable = [
        'student_id',
        'current_streak',
        'best_streak',
        'last_activity_date',
        'history',
    ];

    protected function casts(): array
    {
        return [
            'current_streak'     => 'integer',
            'best_streak'        => 'integer',
            'last_activity_date' => 'date',
            'history'            => 'array',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }
}
