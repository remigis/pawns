<?php

namespace App\Http\Requests\Api;

use App\Rules\IsMyTransactionRule;
use App\Rules\TransactionNotClaimedRule;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

/**
 * @property int $id;
 */
class ClaimTransactionRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'id' => [
                'bail',
                'required',
                'integer',
                'exists:transactions,id',
                new IsMyTransactionRule(),
                new TransactionNotClaimedRule()],
        ];
    }

    public function messages()
    {
        return [
            'id.exists' => "You don't have a transaction with this id.",
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
