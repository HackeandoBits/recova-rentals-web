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

        // Enable IDENTITY_INSERT for SQL Server
        $driver = DB::connection()->getDriverName();
        if ($driver === 'sqlsrv') {
            DB::statement('SET IDENTITY_INSERT categories ON');
        }

        foreach ($categories as $id => $name) {
            DB::table('categories')->updateOrInsert(
                ['id' => $id],
                ['name' => $name, 'slug' => \Illuminate\Support\Str::slug($name)]
            );
        }

        // Disable IDENTITY_INSERT for SQL Server
        if ($driver === 'sqlsrv') {
            DB::statement('SET IDENTITY_INSERT categories OFF');
        }

        foreach ($items as $item) {
            DB::table('items')->updateOrInsert(
                ['slug' => $item['slug']],
                [
                    'name' => $item['name'],
                    'category_id' => $item['category_id'],
                    'active' => true,
                    // Generic placeholders for other required fields if any (check migration but mostly nullable/defaults)
                    /*
                     * =============================================
                     * 📸 IMÁGENES DE LOS PRODUCTOS
                     * =============================================
                     * Las imágenes deben estar en la carpeta: /storage/app/public/items/
                     * El nombre del archivo debe coincidir con el SLUG del producto.
                     * Ejemplo: si el slug es 'pantalla-led', la foto debe ser 'pantalla-led.jpg'.
                     *
                     * Si quieres cambiar la imagen, solo reemplaza el archivo .jpg en esa carpeta.
                     */
                    'image_url' => '/storage/items/'.$item['slug'].'.jpg',
                    'description' => 'Descripción del producto '.$item['name'].'. Puedes editar esto en la base de datos o en la migración.',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]
            );
        }

        // --- VINCULACIÓN DE ITEMS A COMBOS (POBLAR TABLA PIVOTE) ---
        // Definimos qué items tiene cada combo (copiado de la lógica visual)
        // NOTA: Esta lógica se mueve aquí para asegurar que TANTO los Combos (migración anterior)
        // COMO los Items (esta migración) existan antes de vincularlos.

        $comboItemsMap = [
            // Batch 1
            'combo-001' => ['laser-show', 'estructura-truss'],
            'combo-002' => ['tarima', 'beam-light'],
            'combo-003' => ['beam-light', 'estructura-truss'],
            'combo-004' => ['laser-show', 'maquina-humo'],
            'combo-005' => ['pista-led', 'estructura-truss'],
            // Batch 2
            'combo-006' => ['tarima', 'wash-light'],
            'combo-007' => ['pantalla-led', 'beam-light'],
            'combo-008' => ['pista-led', 'laser-show'],
            'combo-009' => ['beam-light', 'maquina-humo'],
            'combo-010' => ['bola-espejo', 'beam-light'],
            // Batch 3
            'combo-011' => ['bola-espejo', 'wash-light'],
            'combo-012' => ['pantalla-led', 'wash-light'],
            'combo-013' => ['bola-espejo', 'wash-light'],
            'combo-014' => ['bola-espejo', 'efecto-led'], // 'efecto-led' podría no estar en items, verificar
            'combo-015' => ['co2', 'confetti'],
            // Batch 4
            'combo-016' => ['beam-light', 'pantalla-led'],
            'combo-017' => ['bola-espejo', 'wash-light'],
            'combo-018' => ['bola-espejo'],
            'combo-019' => ['beam-light', 'bola-espejo'],
            'combo-020' => ['pista-led', 'beam-light'],
            // Batch 5
            'combo-021' => ['pantalla-led', 'beam-light'],
            'combo-022' => ['estructura-truss', 'wash-light'],
            'combo-023' => ['bola-espejo', 'wash-light'],
            'combo-024' => ['pantalla-led', 'pista-led'],
            'combo-025' => ['laser-show', 'beam-light'],
            // Batch 6
            'combo-026' => ['pantalla-led-curva'],
            'combo-027' => ['bola-espejo', 'beam-light'],
            'combo-028' => ['pantalla-led', 'laser-show'],
            'combo-029' => ['estructura-truss', 'pantalla-led'],
            'combo-030' => ['letras-led'],
            // Batch 7
            'combo-031' => ['pantalla-led', 'tarima'],
            'combo-032' => ['bola-espejo'],
            'combo-033' => ['bola-espejo', 'beam-light'],
            'combo-034' => ['laser-show', 'maquina-humo'],
        ];

        // Obtenemos los IDs necesarios
        $itemIds = DB::table('items')->pluck('id', 'slug');
        $comboIds = DB::table('combos')->pluck('id', 'slug');

        foreach ($comboItemsMap as $comboSlug => $itemSlugs) {
            if (! isset($comboIds[$comboSlug])) {
                continue;
            }

            $comboId = $comboIds[$comboSlug];

            foreach ($itemSlugs as $itemSlug) {
                // Manejo de casos especiales o correcciones de slugs si fuera necesario
                if (isset($itemIds[$itemSlug])) {
                    $itemId = $itemIds[$itemSlug];

                    // Insertar en pivote
                    DB::table('combo_item')->updateOrInsert(
                        ['combo_id' => $comboId, 'item_id' => $itemId],
                        ['quantity' => 1]
                    );
                }
            }

            // --- CARACTERÍSTICAS Y ESPECIFICACIONES TÉCNICAS (ITEM FEATURES & SPECS) ---

            $featuresMap = [
                'pantalla-led' => ['Alta resolución P3', 'Brillo ajustable', 'Uso interior/exterior', 'Conectividad HDMI/DVI'],
                'pantalla-led-curva' => ['Diseño flexible', 'Inmersión visual', 'Alta tasa de refresco', 'Configuración modular'],
                'beam-light' => ['Haz de luz concentrado', 'Colores intensos', 'Movimiento rápido', 'Control DMX 16 canales'],
                'wash-light' => ['Baño de color amplio', 'Mezcla RGBW suave', 'Zoom motorizado', 'Ideal para ambientación'],
                'spot-light' => ['Gobos intercambiables', 'Enfoque nítido', 'Prisma rotativo', 'Proyección de logotipos'],
                'laser-show' => ['Gráficos 3D', 'Miles de colores', 'Audiorítmico', 'Seguro para la vista'],
                'bola-espejo' => ['Efecto clásico', 'Reflejos nítidos', 'Motor incluido', 'Varios tamaños'],
                'maquina-humo' => ['Humo bajo denso', 'Sin olor', 'Calentamiento rápido', 'Control remoto'],
                'confetti' => ['Disparo de aire comprimido', 'Alcance 10-15m', 'Papel ignífugo', 'Efecto lluvia'],
                'co2' => ['Chorro criogénico', 'Efecto refrescante', 'Disparo instantáneo', 'Seguro para interiores'],
                'pista-led' => ['Suelo interactivo', 'Soporta alto peso', 'Patrones dinámicos', 'Superficie antideslizante'],
                'tarima' => ['Altura ajustable', 'Superficie modular', 'Acabado profesional', 'Peldaños incluidos'],
                'estructura-truss' => ['Aluminio reforzado', 'Montaje rápido', 'Soporta gran carga', 'Diseño versátil'],
                'letras-led' => ['1 metro de altura', 'Iluminación RGB', 'Control individual', 'Tipografía moderna'],
            ];

            $specsMap = [
                'pantalla-led' => ['Pixel Pitch' => '3.91mm', 'Brillo' => '4500 nits', 'Consumo' => '600W/m2', 'Peso' => '12kg/panel'],
                'pantalla-led-curva' => ['Radio de curvatura' => '+/- 15°', 'Pixel Pitch' => '2.9mm', 'Brillo' => '3500 nits', 'Peso' => '8kg/panel'],
                'beam-light' => ['Lámpara' => '7R 230W', 'Temperatura color' => '8000K', 'Canales DMX' => '16/20', 'Peso' => '17kg'],
                'wash-light' => ['LEDs' => '36x10W RGBW', 'Zoom' => '15°-60°', 'Consumo' => '400W', 'Vida útil' => '50,000 hs'],
                'spot-light' => ['LED' => '150W White', 'Gobos' => '7 rotativos + open', 'Prisma' => '3 caras', 'Enfoque' => 'Motorizado'],
                'laser-show' => ['Potencia' => '3000mW', 'Escáner' => '25kpps', 'Modos' => 'Auto/Sound/DMX/ILDA', 'Diodos' => 'RGB Analógico'],
                'bola-espejo' => ['Diámetro' => '50cm', 'Material' => 'Espejo cristal real', 'Motor' => '1.5 RPM', 'Peso' => '5kg'],
                'maquina-humo' => ['Potencia' => '3000W', 'Salida' => '40000 cu.ft/min', 'Tanque' => '2.5L', 'Tiempo calentamiento' => '4 min'],
                'confetti' => ['Mecanismo' => 'Aire Comprimido / CO2', 'Consumible' => 'Papel metálico/papel', 'Alcance' => '12 metros', 'Control' => 'Manual/DMX'],
                'co2' => ['Manguera' => 'Alta presión 3m', 'Alcance' => '8 metros', 'Accionamiento' => 'Gatillo manual', 'Peso' => '3kg'],
                'pista-led' => ['Resolución' => '10mm', 'Carga máx' => '500kg/panel', 'Protección' => 'IP65', 'Consumo' => '100W/panel'],
                'tarima' => ['Módulo' => '2x1m', 'Altura' => '0.2 - 1.4m', 'Carga' => '750kg/m2', 'Material' => 'Aluminio y Fenólico'],
                'estructura-truss' => ['Tipo' => 'K30 Cuadrada', 'Aleación' => 'EN-AW 6082 T6', 'Tubo principal' => '50x2mm', 'Unión' => 'Cónica'],
                'letras-led' => ['Altura' => '100cm', 'Material' => 'Chapa pintada', 'Luces' => 'Módulos LED Pixel', 'Voltaje' => '12V'],
            ];

            foreach ($itemIds as $slug => $id) {
                // Seed Features
                if (isset($featuresMap[$slug])) {
                    $sort = 0;
                    foreach ($featuresMap[$slug] as $text) {
                        DB::table('item_features')->updateOrInsert(
                            ['item_id' => $id, 'text' => $text],
                            ['sort_order' => $sort++, 'created_at' => now(), 'updated_at' => now()]
                        );
                    }
                }

                // Seed Specs
                if (isset($specsMap[$slug])) {
                    $sort = 0;
                    foreach ($specsMap[$slug] as $key => $val) {
                        DB::table('item_specs')->updateOrInsert(
                            ['item_id' => $id, 'spec_key' => $key],
                            ['spec_value' => $val, 'sort_order' => $sort++, 'created_at' => now(), 'updated_at' => now()]
                        );
                    }
                }
            }

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
