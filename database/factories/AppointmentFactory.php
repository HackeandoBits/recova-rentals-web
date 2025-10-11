<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Appointment;
use App\Models\Booking;
use App\Models\User;
use Illuminate\Support\Carbon;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Appointment>
 */
class AppointmentFactory extends Factory
{
    protected $model = Appointment::class;

    public function definition(): array
    {
        $start = Carbon::now()->addDays(2)->setTime(10, 0); // 10:00 AR
        $end   = (clone $start)->addMinutes(45);

        return [
            'booking_id'       => Booking::inRandomOrder()->value('id') ?? Booking::factory(),
            'assigned_user_id' => User::inRandomOrder()->value('id') ?? User::factory(),
            'starts_at'        => $start,
            'ends_at'          => $end,
            'channel'          => 'office',          // office | whatsapp | email
            'location_note'    => null,
            'status'           => 'scheduled',       // scheduled | done | cancelled
        ];
    }

    public function forUser(int $userId): static
    {
        return $this->state(fn() => ['assigned_user_id' => $userId]);
    }

    public function slot($start, int $minutes = 45): static
    {
        $s = \Illuminate\Support\Carbon::parse($start);
        $e = (clone $s)->addMinutes($minutes);
        return $this->state(fn() => ['starts_at' => $s, 'ends_at' => $e]);
    }

    public function channel(string $channel): static
    {
        return $this->state(fn() => ['channel' => $channel]);
    }
}
