<?php

namespace App\Models;

use App\Enums\DestinationType;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Builder;

class Destination extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'type',
        'emoji',
        'code'
    ];

    protected $casts = [
        'type' => DestinationType::class,
    ];

    /**
     * @return HasMany<Submission>
     */
    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    protected function scopeCode(Builder $query, string $code): void
    {
        $query->where('code', $code);
    }

    protected function scopeType(Builder $query, DestinationType $type): void
    {
        $query->where('type', $type);
    }

    protected function scopeWhereNameLike(Builder $query, string $name): void
    {
        $query->whereLike(
            'name',
            "%" . $name . "%"
        );
    }
}
