<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Item;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ItemFactory extends Factory
{
    protected $model = Item::class;

    public function definition(): array
    {
        $name = ucfirst($this->faker->words(3, true));

        return [
            'category_id' => Category::factory(),
            'name' => $name,
            'slug' => Str::slug($name.'-'.$this->faker->unique()->numberBetween(1, 9999)),
            'description' => $this->faker->paragraph(),
            'stock' => $this->faker->numberBetween(0, 20),
            'active' => true,
        ];
    }
}
