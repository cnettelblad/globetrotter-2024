<?php

namespace App\Http\Requests;

use App\Enums\Month;
use App\Models\Contestant;
use App\Models\Destination;
use App\Models\Submission;
use Doctrine\Inflector\RulesetInflector;
use Illuminate\Container\Attributes\RouteParameter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateSubmissionRequest extends FormRequest
{
    public function rules(
        #[RouteParameter('contestant')] Contestant $contestant
    ): array {
        return [
            'month' => [
                'required',
                Rule::enum(Month::class),
                Rule::unique(Submission::class)->where(
                    'contestant_id',
                    $contestant->id
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
            'month.unique' => 'The contestant already has a submission this month.',
        ];
    }
}
