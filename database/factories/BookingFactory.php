<?php

namespace Database\Factories;

use App\Models\Booking;
use Illuminate\Database\Eloquent\Factories\Factory;

class BookingFactory extends Factory
{
    protected $model = Booking::class;

    public function definition(): array
    {
        return [
            'customer_name' => $this->faker->name(),
            'customer_email'=> $this->faker->safeEmail(),
            'customer_phone'=> $this->faker->optional()->phoneNumber(),
            'event_date'    => now()->addDays($this->faker->numberBetween(3, 20))->toDateString(),
            'meeting_type'  => 'none',
            'meeting_date'  => null,
            'meeting_time_note' => null,
            'service_type'  => 'Alquiler',
            'notes'         => $this->faker->optional()->sentence(),
            'status'        => 'pending',
            'created_by_user_id' => null,
        ];
    }
}
