<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class ImportFailure extends Model
{
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'key',
        'value',
        'error',
    ];

    public function contestant(): BelongsTo
    {
        return $this->belongsTo(Contestant::class);
    }
}
