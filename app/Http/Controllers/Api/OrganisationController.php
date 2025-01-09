<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

        if (isset($params['operation_name'])) {
            ### пойск по названию
        }

        return response()->json($data->get());
    }

    public function show(int $id): JsonResponse
    {
        # 4. вывод информации об организации по её идентификатору
        $data = Organisation::find($id);

        return $data
            ? response()->json($data)
            : response()->json([
                'status' => false,
                'message' => 'Организация не существует.'
            ], 404);
    }
}
