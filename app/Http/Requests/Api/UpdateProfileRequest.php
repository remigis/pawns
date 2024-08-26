<?php

namespace App\Http\Requests\Api;

use App\Rules\AnswerRule;
use App\Rules\ProfileCanBeUpdatedOnceADay;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @property array $answers;
 */
class UpdateProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'answers' => ['bail', 'required', 'array', new ProfileCanBeUpdatedOnceADay()],
            'answers.*.questionId' => 'bail|required|exists:profiling_questions,id',
            'answers.*.answer' => ['required'],
            'answers.*' => [new AnswerRule()],
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(
            response()->json([
                'message' => 'Validation failed',
                'errors' => $validator->errors()
            ], 422)
        );
    }
}
