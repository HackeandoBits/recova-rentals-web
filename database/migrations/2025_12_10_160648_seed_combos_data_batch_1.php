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
        $combos = [
            // Batch 1 (001-005) - Definidos visualmente
            ['slug' => 'combo-001', 'name' => 'Anillo Láser Azul'],
            ['slug' => 'combo-002', 'name' => 'Pasarela Chispas Frías'],
            ['slug' => 'combo-003', 'name' => 'Escenario Beam Star'],
            ['slug' => 'combo-004', 'name' => 'Matriz Láser Disco'],
            ['slug' => 'combo-005', 'name' => 'Túnel Triángulo Neón'],

            // Batch 2 (006-010)
            ['slug' => 'combo-006', 'name' => 'Escenario Boda Elegante'],
            ['slug' => 'combo-007', 'name' => 'Quinceaños Lujo Vertical'],
            ['slug' => 'combo-008', 'name' => 'Pista Láser Verde y Espejos'],
            ['slug' => 'combo-009', 'name' => 'Show Beam Rojo Intenso'],
            ['slug' => 'combo-010', 'name' => 'Techo Espejo y Control Beam'],

            // Batch 3 (011-015)
            ['slug' => 'combo-011', 'name' => 'Cielo Bolas Espejadas Cálido'],
            ['slug' => 'combo-012', 'name' => 'Escenario Azul y Pantallas'],
            ['slug' => 'combo-013', 'name' => 'Atmósfera Roja y Bolas Disco'],
            ['slug' => 'combo-014', 'name' => 'Techo Bolas Disco RGB'],
            ['slug' => 'combo-015', 'name' => 'Fiesta CO2 y Accesorios LED'],

            // Batch 4 (016-020)
            ['slug' => 'combo-016', 'name' => 'Pista Beams Verdes y Pantallas'],
            ['slug' => 'combo-017', 'name' => 'Escenario Beams Azules y Pantallas'],
            ['slug' => 'combo-018', 'name' => 'Fiesta Bolas Disco Rojas'],
            ['slug' => 'combo-019', 'name' => 'Techo Completo Bolas Disco'],
            ['slug' => 'combo-020', 'name' => 'Fiesta Disco RGB y Beams'],

            // Batch 5 (021-025)
            ['slug' => 'combo-021', 'name' => 'Techo Pantallas LED y Beams Dorados'],
            ['slug' => 'combo-022', 'name' => 'Techo Bolas Disco y Atmósfera Rosa'],
            ['slug' => 'combo-023', 'name' => 'Escenario Floral LED y Puntos de Piso'],
            ['slug' => 'combo-024', 'name' => 'Show Láser Haz Verde'],
            ['slug' => 'combo-025', 'name' => 'Estructura Circular y Bañado Azul'],

            // Batch 6 (026-030)
            ['slug' => 'combo-026', 'name' => 'Escenario Pantalla LED Paisaje'],
            ['slug' => 'combo-027', 'name' => 'Techo Bolas Disco y Arañas'],
            ['slug' => 'combo-028', 'name' => 'Pantallas LED Divididas y Láseres'],
            ['slug' => 'combo-029', 'name' => 'Estructura Pantalla Aérea'],
            ['slug' => 'combo-030', 'name' => 'Letras LOVE LED Gigantes'],

            // Batch 7 (031-034)
            ['slug' => 'combo-031', 'name' => 'Escenario Exterior Mandala LED'],
            ['slug' => 'combo-032', 'name' => 'Cortina Bolas Disco Vertical'],
            ['slug' => 'combo-033', 'name' => 'Techo Disco y Arañas Azules'],
            ['slug' => 'combo-034', 'name' => 'Experiencia Túnel Láser Azul'],
        ];

        /*
        // Ya no necesitamos generar placeholders, todos tienen nombre.
        // Generar el resto hasta el 034
        for ($i = 35; $i <= 34; $i++) {
             // ...
        }
        */

        foreach ($combos as $data) {
            // Usamos updateOrInsert para evitar duplicados si se corre varias veces
            DB::table('combos')->updateOrInsert(
                ['slug' => $data['slug']],
                [
                    'name' => $data['name'],
                    'active' => true,
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
        // Opcional: Borrar los combos creados
        $slugs = [];
        for ($i = 1; $i <= 34; $i++) {
            $slugs[] = 'combo-'.str_pad($i, 3, '0', STR_PAD_LEFT);
        }

        DB::table('combos')->whereIn('slug', $slugs)->delete();
    }
};
