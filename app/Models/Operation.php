<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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
}
