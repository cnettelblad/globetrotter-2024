<?php

namespace App\Http\Resources;

use App\Models\Contestant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ContestantResource extends JsonResource
{
    public function __construct(Contestant $resource)
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
            'name' => $this->name,
            'email' => $this->email,
            'submissions' => SubmissionResource::collection($this->whenLoaded('submissions')),
            'score' => $this->whenHas('submissions_count'),
            'lacks_image' => $this->whenHas('lacks_image_count'),
        ];
    }
}
