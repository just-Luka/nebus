<?php

declare(strict_types=1);

namespace App\Http\Requests;

final class OrganisationRequest extends BaseRequest
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
            'organisation_name' => 'string|nullable',
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
}
