<?php

namespace Database\Factories;

use App\Models\Combo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ComboFactory extends Factory
{
    protected $model = Combo::class;

    public function definition(): array
    {
        $name = 'Kit '.$this->faker->unique()->words(2, true);
        return [
            'name'   => ucfirst($name),
            'slug'   => Str::slug($name),
            'active' => true,
        ];
    }
}
