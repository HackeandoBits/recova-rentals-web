<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Carbon;

class AppointmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Asegura que haya al menos 1 usuario y 1 booking
        $userId = User::value('id');
        if (!$userId) {
            $userId = User::factory()->admin()->create()->id; // crea admin si no existía
        }

        $bookingId = Booking::value('id');
        if (!$bookingId) {
            $bookingId = Booking::factory()->create()->id;
        }

        // Slots reproducibles (NO solapados) para assigned_user_id = $userId
        $day   = Carbon::now()->addDays(2)->toDateString();

        $slots = [
            ['start' => "{$day} 10:00:00", 'minutes' => 45, 'channel' => 'office',   'note' => 'Sala 1'],
            ['start' => "{$day} 11:15:00", 'minutes' => 30, 'channel' => 'whatsapp', 'note' => 'Enviar lista de precios'],
            ['start' => "{$day} 12:00:00", 'minutes' => 30, 'channel' => 'email',    'note' => 'Responder consulta'],
        ];

        foreach ($slots as $s) {
            $start = Carbon::parse($s['start']);
            $end   = (clone $start)->addMinutes($s['minutes']);

            // Idempotente por tu unique (booking_id, assigned_user_id, starts_at)
            Appointment::firstOrCreate(
                [
                    'booking_id'       => $bookingId,
                    'assigned_user_id' => $userId,
                    'starts_at'        => $start,
                ],
                [
                    'ends_at'       => $end,
                    'channel'       => $s['channel'],
                    'location_note' => $s['note'],
                    'status'        => 'scheduled',
                ]
            );
        }

        // Si querés probar solape, descomenta este bloque (choca con 10:30–11:15)
        /*
        $startOverlap = Carbon::parse("{$day} 10:30:00");
        Appointment::firstOrCreate(
            [
                'booking_id'       => $bookingId,
                'assigned_user_id' => $userId,
                'starts_at'        => $startOverlap,
            ],
            [
                'ends_at'       => (clone $startOverlap)->addMinutes(45),
                'channel'       => 'office',
                'location_note' => 'Test solape',
                'status'        => 'scheduled',
            ]
        );
        */
    }
}
