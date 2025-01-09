<?php

namespace Database\Seeders;

use App\Models\Organisation;
use Database\Factories\OperationFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        Organisation::factory(10)->create();
        OperationFactory::execute();
    }
}
