<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Diagnostic extends Model
{
    use HasUuids;

    protected $fillable = [
        'student_id',
        'status',
        'completed_at',
    ];

    protected function casts(): array
    {
        return [
            'completed_at' => 'datetime',
        ];
    }

    public function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    }

    public function activities(): BelongsToMany
    {
        return $this->belongsToMany(Activity::class, 'diagnostic_activities')
            ->withPivot('order_index')
            ->orderBy('diagnostic_activities.order_index');
    }
}
