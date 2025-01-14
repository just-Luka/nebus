<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\DTO\OrganisationDTO;
use App\Http\Requests\OrganisationRequest;
use App\Models\Organisation;
use Illuminate\Http\JsonResponse;

final class OrganisationController extends Controller
{
    public function index(OrganisationRequest $request): JsonResponse
    {
        $params = $request->validated();
        $data = Organisation::query();

        # 1. список всех организаций находящихся в конкретном здании
        if (isset($params['building_id'])) {
            $data->where('building_id', $params['building_id']);
        }

        # 2. список всех организаций, которые относятся к указанному виду деятельности
        if (isset($params['operation_id'])) {
            $data->whereHas('operations', static function ($query) use ($params) {
                $query->where('operation_id', $params['operation_id']);
            });
        }

        # 6. поиск организации по названию
        if (isset($params['organisation_name'])) {
            $data->where('name', 'ilike', '%' . $params['organisation_name'] . '%' );
        }

        return response()->json([
            'status' => true,
            'message' => 'Успешно!',
            'data' => OrganisationDTO::fromPagination($data->paginate(15))
        ]);
    }

    public function show(int $id): JsonResponse
    {
        # 4. вывод информации об организации по её идентификатору
        $data = Organisation::find($id);
        if (is_null($data)) {
            return response()->json([
                'status' => false,
                'message' => 'Организация не существует.',
                'data' => []
            ], 404);
        }

        return response()->json([
            'status' => true,
            'message' => 'Организация найдена.',
            'data' => OrganisationDTO::fromSingle($data),
        ]);
    }
}
