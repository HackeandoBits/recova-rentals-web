<?php

namespace Database\Factories;

use App\Models\ItemSpec;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;

class ItemSpecFactory extends Factory
{
    protected $model = ItemSpec::class;

    public function definition(): array
    {
        $pairs = [
            ['spec_key'=>'Uso','spec_value'=>'Indoor'],
            ['spec_key'=>'Uso','spec_value'=>'Outdoor'],
            ['spec_key'=>'Brillo (nits)','spec_value'=>'1200'],
            ['spec_key'=>'Resolución','spec_value'=>'Full HD'],
            ['spec_key'=>'Paso de pixel','spec_value'=>'P3.9'],
        ];
        $p = $this->faker->randomElement($pairs);
        return [
            'item_id'    => Item::factory(),
            'spec_key'   => $p['spec_key'],
            'spec_value' => $p['spec_value'],
            'sort_order' => 10,
        ];
    }
}
