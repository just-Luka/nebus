<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Building;
use Illuminate\Database\Eloquent\Factories\Factory;

final class OrganisationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'phone' => array_map(static fn() => fake()->phoneNumber(), range(1, mt_rand(2, 5))),
            'building_id' => Building::factory(),
        ];
    }
}
