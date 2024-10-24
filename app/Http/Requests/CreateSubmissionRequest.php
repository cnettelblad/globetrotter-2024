<?php

namespace App\Http\Requests;

use App\Enums\Month;
use App\Models\Destination;
use Doctrine\Inflector\RulesetInflector;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateSubmissionRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'month' => [
                'required',
                Rule::enum(Month::class)
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
}
