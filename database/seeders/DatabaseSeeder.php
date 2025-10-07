<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\{User,Item,ItemImage,Category};
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder {
    public function run(): void {
        $owner = User::factory()->create([
            'name' => 'Owner', 'email' => 'owner@example.com', 'password' => Hash::make('password')
        ]);
        RoleSeeder::run();
    }
}