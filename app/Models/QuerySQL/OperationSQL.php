<?php

declare(strict_types=1);

namespace App\Models\QuerySQL;

final readonly class OperationSQL
{
    /**
     * Получить SQL-запрос для иерархии организации.
     *
     * Параметры:
     * - `?` (string): Имя операции для фильтрации.
     *
     * @return string SQL-запрос.
     */
    public static function hierarchy(): string
    {
        return <<<SQL
WITH RECURSIVE operation_hierarchy AS (
    SELECT id, parent_id, name
    FROM operations
    WHERE name = ?
    UNION ALL
    SELECT o.id, o.parent_id, o.name
    FROM operations o
    INNER JOIN operation_hierarchy oh ON o.parent_id = oh.id
)
SELECT DISTINCT
    org.id,
    org.name
FROM organisations org
INNER JOIN organisation_operation oo ON org.id = oo.organisation_id
INNER JOIN operation_hierarchy oh ON oo.operation_id = oh.id;
SQL;
    }
}
