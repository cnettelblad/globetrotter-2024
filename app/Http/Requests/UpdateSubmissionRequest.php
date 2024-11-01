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
                function (string $attribute, string $value, \Closure $fail) {
                    if (!Destination::whereNameLike($value)->exists()) {
                        $fail("The selected $attribute could not be found.");
                    }
                }
            ],
            'image' => ['sometimes', 'nullable', 'image']
        ];
    }

    public function messages()
    {
        return [
            'month.unique' => 'This contestant has already submitted for :month.',
        ];
    }
}
