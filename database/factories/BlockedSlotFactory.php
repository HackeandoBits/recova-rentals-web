<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\BlockedSlot;
use App\Models\User;

class BlockedSlotFactory extends Factory
{
    protected $model = BlockedSlot::class;

    public function definition(): array
    {
        $from = now()->addDays(fake()->numberBetween(5, 20))->startOfDay();
        $to   = (clone $from)->addDays(fake()->numberBetween(0, 2));

        return [
            'owner_user_id' => User::factory(),
            'date_from'     => $from->toDateString(),
            'date_to'       => $to->toDateString(),
            'reason'        => fake()->randomElement(['Mantenimiento','Evento propio']),
            'source'        => 'manual',
        ];
    }

    public function forOwner(int $userId): static
    {
        return $this->state(fn () => ['owner_user_id' => $userId]);
    }

    public function range(string $from, string $to, ?string $reason = null): static
    {
        return $this->state(fn () => [
            'date_from' => $from,
            'date_to'   => $to,
            'reason'    => $reason,
        ]);
    }
}
