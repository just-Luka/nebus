<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\QuerySQL\OperationSQL;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

final class Operation extends Model
{
    protected $casts = [
        'name' => 'string',
        'parent_id' => 'integer',
    ];

    /**
     * @return BelongsToMany
     */
    public function organisations(): BelongsToMany
    {
        return $this->belongsToMany(Organisation::class, 'organisation_operation', 'operation_id', 'organisation_id');
    }

    /**
     * @return BelongsToMany
     */
    public function children(): BelongsToMany
    {
        return $this->belongsToMany(self::class, 'parent_operation', 'operation_id', 'parent_id');
    }

    /**
     * Искать организации по виду деятельности.
     * Например, поиск по виду деятельности «Еда»,
     * которая находится на первом уровне дерева, и чтобы нашлись все организации,
     * которые относятся к видам деятельности, лежащим внутри.
     * Т.е. в результатах поиска должны отобразиться организации
     * с видом деятельности Еда, Мясная продукция, Молочная продукция.
     * @param string $operationName
     * @return array
     */
    public static function getOrganisationHierarchy(string $operationName): array
    {
        return DB::select(OperationSQL::hierarchy(), [$operationName]);
    }
}
