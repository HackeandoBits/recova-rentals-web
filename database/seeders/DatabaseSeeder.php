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
            BookingSeeder::class,

            RolesSeeder::class,   // crea roles Spatie
            UserSeeder::class,    // crea usuarios y asigna roles
            BlockedSlotSeeder::class,
            AppointmentSeeder::class,
        ]);
    }
}
