<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Booking;
use App\Models\BookingItem;
use App\Models\Item;
use App\Models\Combo;

class BookingSeeder extends Seeder
{
    public function run(): void
    {
        $booking = Booking::factory()->create([
            'event_date' => now()->addDays(10)->toDateString(),
            'status'     => 'pending',
        ]);

        $item  = Item::inRandomOrder()->first();
        $combo = Combo::inRandomOrder()->first();

        if ($item) {
            BookingItem::create([
                'booking_id'   => $booking->id,
                'product_type' => \App\Models\Item::class,
                'product_id'   => $item->id,
                'name'         => $item->name,
                'category'     => $item->category?->name ?? 'N/D',
                'description'  => $item->description,
                'quantity'     => 1,
                'note'         => null,
            ]);
        }
        if ($combo) {
            BookingItem::create([
                'booking_id'   => $booking->id,
                'product_type' => \App\Models\Combo::class,
                'product_id'   => $combo->id,
                'name'         => $combo->name,
                'category'     => 'Combo',
                'description'  => 'Paquete promocional',
                'quantity'     => 1,
                'note'         => null,
            ]);
        }
    }
}
