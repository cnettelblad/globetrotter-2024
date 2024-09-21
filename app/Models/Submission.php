<?php

namespace App\Models;

use App\Enums\Month;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'discord_id',
        'month',
        'submission',
        'image'
    ];

    protected $casts = [
        'month' => Month::class,
    ];

    protected $with = [
        'destination'
    ];

    public function contestant(): BelongsTo
    {
        return $this->belongsTo(Contestant::class);
    }

    public function destination(): BelongsTo
    {
        return $this->belongsTo(Destination::class);
    }
}
