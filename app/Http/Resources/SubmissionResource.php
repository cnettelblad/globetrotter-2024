<?php

namespace App\Http\Resources;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\Storage;

/**
 * @mixin Submission
 */
class SubmissionResource extends JsonResource
{
    public function __construct(Submission $resource)
    {
        parent::__construct($resource);
    }

    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'month' => $this->month,
            'image' => route('submissions.image', ['submission' => $this->id]),
            'destination' => new DestinationResource($this->whenLoaded('destination')),
        ];
    }
}
