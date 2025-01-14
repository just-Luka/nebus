<?php

declare(strict_types=1);

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\ValidationException;

abstract class BaseRequest extends FormRequest
{
    /**
     * @param Validator $validator
     * @throws ValidationException
     * #[Override]
     */
    protected function failedValidation(Validator $validator): void
    {
        throw new ValidationException(
            $validator,
            response()->json([
                'status' => false,
                'message' => 'Ошибка валидации',
                'data' => $validator->errors()
            ], 422)
        );
    }
}
