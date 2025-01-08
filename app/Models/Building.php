<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

final class Building extends Model
{
    use HasFactory;

    protected $casts = [
        'address_line' => 'integer',
        'city' => 'string',
        'country' => 'json',
        'building_id' => 'integer',
        'latitude' => 'float',
        'longitude' => 'float',
    ];
}
