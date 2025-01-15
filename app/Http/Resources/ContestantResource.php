<?php

namespace App\Http\Resources;

use App\Models\Contestant;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * @mixin Contestant
 */
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
            'username' => $this->username,
            'nickname' => $this->nickname,
            'avatar' => $this->avatar,
            'submissions' => SubmissionResource::collection($this->whenLoaded('submissions')),
            'score' => $this->whenHas('submissions_count')
        ];
    }
}
