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

    public function organisations(): BelongsToMany
    {
        return $this->belongsToMany(Organisation::class);
    }
}
