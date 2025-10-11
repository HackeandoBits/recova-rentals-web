<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        // Limpia cache interna del paquete
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // Crea SOLO roles
        Role::firstOrCreate(['name' => 'Admin', 'guard_name' => 'web']);
        Role::firstOrCreate(['name' => 'User',  'guard_name' => 'web']);
    }
}
