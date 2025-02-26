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
use Spatie\Image\Image;

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

    public function storeImage(UploadedFile $image)
    {
        $destination = 'submissions/' . uniqid() . '.webp';

        Image::load($image->getPathname())
            ->width(1920)
            ->height(1920)
            ->format('webp')
            ->quality(80)
            ->optimize()
            ->save(Storage::path($destination));

        $this->image = $destination;
    }
}
