<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SessionActivity extends Model
{
    use HasUuids;

    protected $table = 'session_activities';

    protected $fillable = [
        'session_id',
        'activity_id',
        'order_index',
    ];

    public function session(): BelongsTo
    {
        return $this->belongsTo(StudentSession::class, 'session_id');
    }

    public function activity(): BelongsTo
    {
        return $this->belongsTo(Activity::class);
    }
}
