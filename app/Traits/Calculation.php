<?php

declare(strict_types=1);

namespace App\Traits;

trait Calculation
{
    private const EARTH_RADIUS = 6371;

    /**
     * [Этот код генерирован через Ai]
     *
     * @param float $lat1
     * @param float $lon1
     * @param float $lat2
     * @param float $lon2
     * @return float
     */
    protected function haversineDistance(float $lat1, float $lon1, float $lat2, float $lon2): float
    {
        $lat1Rad = deg2rad($lat1);
        $lon1Rad = deg2rad($lon1);
        $lat2Rad = deg2rad($lat2);
        $lon2Rad = deg2rad($lon2);

        // Разница координат
        $deltaLat = $lat2Rad - $lat1Rad;
        $deltaLon = $lon2Rad - $lon1Rad;

        // Формула Хаверсина
        $a = sin($deltaLat / 2) ** 2 +
            cos($lat1Rad) * cos($lat2Rad) * sin($deltaLon / 2) ** 2;
        $c = 2 * atan2(sqrt($a), sqrt(1 - $a));

        return self::EARTH_RADIUS * $c;
    }

    /**
     * [Этот код генерирован через Ai]
     *
     * Фильтрация зданий по радиусу.
     *
     * @param array $buildings Массив зданий с координатами.
     * @param float $latitude Широта центральной точки.
     * @param float $longitude Долгота центральной точки.
     * @param float $radius Радиус поиска в километрах.
     * @return array Отфильтрованные здания.
     */
    protected function filterBuildingsByRadius(array $buildings, float $latitude, float $longitude, float $radius): array
    {
        $result = [];

        foreach ($buildings as $building) {
            $distance = $this->haversineDistance(
                $latitude,
                $longitude,
                $building['latitude'],
                $building['longitude']
            );

            if ($distance <= $radius) {
                $building['distance'] = $distance; // Добавляем расстояние в результат
                $result[] = $building;
            }
        }

        // Сортируем по расстоянию
        usort($result, static fn($a, $b) => $a['distance'] <=> $b['distance']);

        return $result;
    }
}
