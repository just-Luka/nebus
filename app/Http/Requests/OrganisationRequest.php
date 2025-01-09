<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

final class OrganisationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * @return array<string, string>
     */
    public function rules(): array
    {
        return [
            'building_id' => 'integer|exists:buildings,id',
            'operation_id' => 'integer|exists:operations,id',
            'operation_name' => 'string|nullable',
        ];
    }

    /**
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'building_id.integer' => 'ID здания должен быть целым числом.',
            'building_id.exists' => 'Выбранный ID здания не существует.',
            'operation_id.integer' => 'ID деятельности должен быть целым числом.',
            'operation_id.exists' => 'Выбранный ID деятельности не существует.'
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
