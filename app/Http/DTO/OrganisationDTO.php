<?php

declare(strict_types=1);

namespace App\Http\DTO;

use App\Models\Organisation;
use Illuminate\Pagination\LengthAwarePaginator;

final readonly class OrganisationDTO
{
    private function __construct(
        public int $page,
        public int $perPage,
        public int $total,
        public array $records,
    ){}

    /**
     * @param LengthAwarePaginator $data
     * @return self
     */
    public static function fromPagination(LengthAwarePaginator $data): self
    {
        return new self(
            page: $data->currentPage(),
            perPage: $data->perPage(),
            total: $data->total(),
            records: $data->getCollection()->toArray(),
        );
    }

    /**
     * @param Organisation $model
     * @return self
     */
    public static function fromSingle(Organisation $model): self
    {
        return new self(
            page: 1,
            perPage: 1,
            total: 1,
            records: [$model],
        );
    }
}
