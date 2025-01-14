<?php

declare(strict_types=1);

namespace App\Http\Requests;

final class BuildingRequest extends BaseRequest
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
            'radius' => 'integer|nullable|min:0',
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
        ];
    }
}
