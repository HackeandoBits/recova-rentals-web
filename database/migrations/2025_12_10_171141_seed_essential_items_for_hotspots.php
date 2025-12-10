<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        $items = [
            // Pantallas
            ['slug' => 'pantalla-led', 'name' => 'Pantalla LED P3', 'category_id' => 1],
            ['slug' => 'pantalla-led-curva', 'name' => 'Pantalla LED Curva', 'category_id' => 1],

            // Luces (Beams, Spots, Wash)
            ['slug' => 'beam-light', 'name' => 'Cabezal Móvil Beam 230', 'category_id' => 2],
            ['slug' => 'wash-light', 'name' => 'Cabezal Móvil Wash LED', 'category_id' => 2],
            ['slug' => 'spot-light', 'name' => 'Cabezal Móvil Spot', 'category_id' => 2],
            ['slug' => 'laser-show', 'name' => 'Láser Show RGB 3W', 'category_id' => 2],

            // Efectos
            ['slug' => 'bola-espejo', 'name' => 'Bola de Espejos 50cm', 'category_id' => 3],
            ['slug' => 'maquina-humo', 'name' => 'Máquina de Humo Baja', 'category_id' => 3],
            ['slug' => 'confetti', 'name' => 'Cañón de Confetti', 'category_id' => 3],
            ['slug' => 'co2', 'name' => 'Pistola CO2', 'category_id' => 3],

            // Estructuras / Otros
            ['slug' => 'pista-led', 'name' => 'Pista LED Infinity', 'category_id' => 4],
            ['slug' => 'tarima', 'name' => 'Tarima Modular', 'category_id' => 4],
            ['slug' => 'estructura-truss', 'name' => 'Estructura Truss 30x30', 'category_id' => 4],
            ['slug' => 'letras-led', 'name' => 'Letras Gigantes LED', 'category_id' => 4],
        ];

        // Asegurar que existan categorías básicas (si no existen las crea)
        // Asumimos IDs 1=Pantallas, 2=Luces, 3=Efectos, 4=Estructuras
        $categories = [
            1 => 'Pantallas LED',
            2 => 'Iluminación',
            3 => 'Efectos Especiales',
            4 => 'Estructuras y Pistas',
        ];

        foreach ($categories as $id => $name) {
            DB::table('categories')->updateOrInsert(
                ['id' => $id],
                ['name' => $name, 'slug' => \Illuminate\Support\Str::slug($name)]
            );
        }

        foreach ($items as $item) {
            DB::table('items')->updateOrInsert(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'category_id' => $item['category_id'],
                    'active' => true,
                    // Generic placeholders for other required fields if any (check migration but mostly nullable/defaults)
                    'description' => 'Descripción del producto '.$item['name'],
                    'image_url' => 'img/products/'.$item['slug'].'.jpg', // Placeholder
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
