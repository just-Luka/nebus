<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

final class Organisation extends Model
{
    use HasFactory;

    protected $casts = [
        'name' => 'string',
        'phone' => 'json',
        'building_id' => 'integer',
    ];

    public function operations(): BelongsToMany
    {
        return $this->belongsToMany(Operation::class);
    }
}
