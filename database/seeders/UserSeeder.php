<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        // Admin
        $admin = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            [
                'name'              => 'Admin',
                'email_verified_at' => now(),
                'password'          => bcrypt('Admin123'),
            ]
        );
        if (!$admin->hasRole('Admin')) {
            $admin->assignRole('Admin'); // Spatie
        }

        // Usuario estándar
        $user = User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            [
                'name'              => 'Usuario',
                'email_verified_at' => now(),
                'password'          => bcrypt('User123'),
            ]
        );
        if (!$user->hasRole('User')) {
            $user->assignRole('User'); // Spatie
        }
    }
}
