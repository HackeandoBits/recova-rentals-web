<?php

namespace Database\Factories;

use App\Models\ItemFeature;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemFeatureFactory extends Factory
{
    protected $model = ItemFeature::class;

    public function definition(): array
    {
        static $order = 10;
        $text = $this->faker->randomElement([
            'Incluye soporte', 'Control remoto', 'Instalación profesional',
            'Soporte técnico 24/7', 'IP65', 'Bluetooth opcional'
        ]);
        $order += 10;
        return [
            'item_id'    => Item::factory(),
            'text'       => $text,
            'sort_order' => $order,
        ];
    }
}
