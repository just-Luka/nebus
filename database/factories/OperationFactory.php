<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Models\Operation;
use Illuminate\Database\Eloquent\Factories\Factory;

final class OperationFactory extends Factory
{
    protected static array $examples = [
        'Еда' => [
            'Мясная продукция',
            'Молочная продукция',
        ],
        'Автомобили' => [
            'Грузовые',
            'Легковые' => [
                'Запчасти',
                'Аксессуары',
            ],
        ],
        'Техника' => [
            'Телевизоры',
            'Холодильники',
            'Стиральные машины',
            'Пылесосы',
            'Кухонная техника' => [
                'Блендеры',
                'Миксеры',
                'Кофеварки',
                'Тостеры',
            ],
        ],
    ];

    /**
     * @return bool
     */
    public static function execute(): bool
    {
        /**
         * @var array<string, mixed> $operations
         */
        $operations = [];
        $id = 1;

        $flatten = static function (array $examples, ?int $parentId) use (&$operations, &$id, &$flatten): void {
            foreach ($examples as $key => $value) {
                $operations[] = [
                    'id' => $id,
                    'name' => is_array($value) ? $key : $value,
                    'created_at' => now(),
                    'updated_at' => now(),
                    'parent_id' => $parentId
                ];

                is_array($value) ? $flatten($value, $id++) : $id++;
            }
        };

        $flatten(self::$examples, null);

        return Operation::insert($operations);
    }

    /**
     * Define the model's default state.
     *
     * @return array<void>
     */
    public function definition(): array
    {
        return [];
    }
}
