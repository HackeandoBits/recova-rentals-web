<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->command->info('>> Sembrando appointments...');

        $this->call([
            CategorySeeder::class,
            ItemSeeder::class,
            ComboSeeder::class,
        ]);
    }
}
