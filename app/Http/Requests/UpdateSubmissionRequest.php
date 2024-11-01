<?php

namespace App\Http\Requests;

use App\Enums\Month;
use App\Models\Destination;
use App\Models\Submission;
use Illuminate\Container\Attributes\RouteParameter;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateSubmissionRequest extends FormRequest
{
    public function rules(
        #[RouteParameter('submission')] Submission $submission
    ): array {
        return [
            'month' => [
                'required',
                Rule::enum(Month::class),
                Rule::unique(Submission::class)->where(
                    'contestant_id',
                    $submission->contestant_id
                )
            ],
            'destination' => [
                'required',
                Rule::exists(Destination::class, 'id')
            ],
            'image' => ['sometimes', 'nullable', 'image']
        ];
    }

    public function messages()
    {
        return [
            'month.unique' => 'The contestant already has a submission this month.',
        ];
    }
}
