<?php

declare(strict_types=1);

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\OperationRequest;
use App\Models\Operation;
use Illuminate\Http\JsonResponse;

final class OperationController extends Controller
{
    public function index(OperationRequest $request): JsonResponse
    {
        $params = $request->validated();

        return response()->json(
            # 5. искать организации по виду деятельности
            Operation::getOrganisationHierarchy($params['root_operation_name']),
        );
    }
}
