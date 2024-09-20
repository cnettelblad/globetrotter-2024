<?php

namespace App\Http\Requests;

use App\Enums\Month;
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
            'submission' => ['required', 'string'],
            'image' => ['sometimes', 'nullable', 'image']
        ];
    }
}
