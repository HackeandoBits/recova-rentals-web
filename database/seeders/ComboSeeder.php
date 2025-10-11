<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Combo;
use App\Models\Item;

class ComboSeeder extends Seeder
{
    public function run(): void
    {
        $combo1 = Combo::factory()->create([
            'name' => 'Kit Pantalla + Sonido Pro',
            'slug' => 'kit-pantalla-sonido-pro',
            'active' => true
        ]);

        $pantalla = Item::whereHas('category', fn($q)=>$q->whereIn('slug',['pantallas-led-indoor','pantallas-led-outdoor']))
                    ->inRandomOrder()->first();
        $parlante = Item::whereHas('category', fn($q)=>$q->where('slug','sonido-parlantes'))
                    ->inRandomOrder()->first();
        $consola  = Item::whereHas('category', fn($q)=>$q->where('slug','sonido-consolas'))
                    ->inRandomOrder()->first();

        if ($pantalla) $combo1->items()->syncWithoutDetaching([$pantalla->id => ['quantity' => 1]]);
        if ($parlante) $combo1->items()->syncWithoutDetaching([$parlante->id => ['quantity' => 2]]);
        if ($consola)  $combo1->items()->syncWithoutDetaching([$consola->id  => ['quantity' => 1]]);

        $combo2 = Combo::factory()->create([
            'name' => 'Kit Escenario + Luces Show',
            'slug' => 'kit-escenario-luces-show',
            'active' => true
        ]);

        $tarimas = Item::whereHas('category', fn($q)=>$q->where('slug','escenario-tarimas'))->inRandomOrder()->first();
        $moving  = Item::whereHas('category', fn($q)=>$q->where('slug','luces-moving-head'))->inRandomOrder()->first();
        $parLed  = Item::whereHas('category', fn($q)=>$q->where('slug','luces-par-led'))->inRandomOrder()->first();

        if ($tarimas) $combo2->items()->syncWithoutDetaching([$tarimas->id => ['quantity' => 1]]);
        if ($moving)  $combo2->items()->syncWithoutDetaching([$moving->id  => ['quantity' => 4]]);
        if ($parLed)  $combo2->items()->syncWithoutDetaching([$parLed->id  => ['quantity' => 8]]);
    }
}
