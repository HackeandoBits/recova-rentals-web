<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlockedSlot;

class BlockedSlotSeeder extends Seeder
{
    public function run(): void
    {
        // Slots reproducibles para owner_id=1
        BlockedSlot::factory()->forOwner(1)->range('2025-10-20','2025-10-22','Mantenimiento')->create();
        BlockedSlot::factory()->forOwner(1)->range('2025-10-28','2025-10-28','Evento propio')->create();
    }
}
