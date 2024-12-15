<?php

namespace App\Models;

use App\Enums\Month;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class Submission extends Model
{
    use HasFactory;
    use HasUuids;

    protected $fillable = [
        'month',
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

    public function image(): Attribute
    {
        return Attribute::make(
            get: function (string|null $image) {
                return $image
                    ? Storage::url($image)
                    : null;
            }
        );
    }

    public function storeImage(UploadedFile $image)
    {
        $this->image = $image->store('submissions');
    }
}
