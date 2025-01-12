<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

final class OperationRequest extends FormRequest
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
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            # Поскольку root_operation_name будет напрямую ставится в sql запросе, regex выражение обеспечивает защиту от sql инекции
            'root_operation_name' => 'required|string|nullable|regex:/^[\p{L}\p{N}_]+$/u',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'root_operation_name.required' => 'Пожалуйста, укажите название деятельности',
        ];
    }

    /**
     * @param Validator $validator
     * @throws ValidationException
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException(
            $validator,
            response()->json($validator->errors(), 422)
        );
    }
}
