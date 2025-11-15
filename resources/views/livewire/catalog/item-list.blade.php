<div 
    class="container mx-auto px-4 pb-16"
    x-data 
    @keydown.escape.window="$wire.closePanel()"
>
    <!-- Header (como en React) -->
    <div class="text-center space-y-6 mb-16">
        <p class="text-xl text-gray-600 dark:text-gray-300 max-w-4xl mx-auto">
            Haz clic en los puntos interactivos para descubrir nuestros equipos y agregar lo que necesites a tu evento
        </p>
    </div>

    <!-- Contenedor de Categorías -->
    <div class="space-y-16">

        {{-- 1. BUCLE DE CATEGORÍAS --}}
        @foreach ($imageCategories as $category)
            <div key="{{ $category['id'] }}" class="space-y-8">
                <!-- Título de Categoría -->
                <div class="text-center space-y-4">
                    <h3 class="text-3xl md:text-4xl font-bold text-gray-900 dark:text-white">
                        {{ $category['title'] }}
                    </h3>
                    <p class="text-lg text-gray-500 dark:text-gray-400 max-w-2xl mx-auto">
                        {{ $category['description'] }}
                    </p>
                </div>

                {{-- 2. BUCLE DE IMÁGENES (Simulando el carrusel) --}}
                @foreach ($category['images'] as $image)
                    <div key="{{ $image['id'] }}" class="relative group">
                        
                        <h4 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 text-center">
                            {{ $image['title'] }}
                        </h4>
                        
                        <!-- Contenedor de la Imagen y Hotspots -->
                        <div class="relative w-full h-[60vh] md:h-[70vh] overflow-hidden rounded-2xl bg-gray-900 border border-gray-700">
                            <img
                                src="{{ $image['image_url'] }}"
                                alt="{{ $image['title'] }}"
                                class="w-full h-full object-cover transition-transform duration-700 group-hover:scale-105"
                            />
                            
                            <!-- Overlay oscuro -->
                            <div class="absolute inset-0 bg-black/30"></div>
                            
                            {{-- 3. BUCLE DE HOTSPOTS --}}
                            @foreach ($image['hotspots'] as $hotspot)
                                <button
                                    type="button"
                                    wire:click="selectItem({{ $hotspot['item_id'] }})"
                                    class="absolute transform -translate-x-1/2 -translate-y-1/2 group/hotspot"
                                    style="left: {{ $hotspot['x'] }}%; top: {{ $hotspot['y'] }}%;"
                                >
                                    <!-- Anillo de pulso -->
                                    <div class="absolute inset-0 rounded-full animate-ping bg-purple-400/50 scale-150"></div>
                                    
                                    <!-- Botón del Hotspot -->
                                    <div class="relative w-12 h-12 bg-purple-600/90 backdrop-blur-sm rounded-full border-2 border-white/30 
                                                flex items-center justify-center text-white shadow-lg 
                                                group-hover/hotspot:scale-110 transition-all duration-300">
                                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path></svg>
                                    </div>

                                    <!-- Tooltip con el nombre (se muestra al hacer hover) -->
                                    <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 px-3 py-1 
                                                bg-black/80 backdrop-blur-sm text-white text-sm 
                                                rounded-lg opacity-0 group-hover/hotspot:opacity-100 
                                                transition-opacity duration-300 whitespace-nowrap pointer-events-none">
                                        {{ $hotspot['name'] }}
                                    </div>
                                </button>
                            @endforeach
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>


    {{-- 
    ================================================================
    PANEL DE DETALLE DEL HOTSPOT (Modal)
    ================================================================
    --}}
    @if ($showDetailPanel && $selectedItem)
        <div 
            class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 z-50"
            @click="$wire.closePanel()"
        >
            <div 
                class="bg-white dark:bg-gray-800 border border-gray-700 rounded-2xl max-w-md w-full max-h-[90vh] overflow-y-auto"
                @click.stop
            >
                <!-- Header del Panel -->
                <div class="relative p-6 border-b border-gray-200 dark:border-gray-700">
                    <button
                        type="button"
                        wire:click="closePanel"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600"
                    >
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path></svg>
                    </button>
                    
                    <div>
                        {{-- Muestra la categoría real de la BBDD --}}
                        <span class="text-sm font-medium text-purple-600 dark:text-purple-400">
                            {{ $selectedItem->category->name ?? 'Producto' }}
                        </span>
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1">
                            {{ $selectedItem->name }}
                        </h3>
                    </div>
                </div>

                <!-- Contenido del Panel -->
                <div class="p-6 space-y-6">

                    @if ($selectedItem->image_url)
                        <div class="h-48 rounded-xl overflow-hidden bg-gray-200 dark:bg-gray-700">
                            <img 
                                src="{{ asset($selectedItem->image_url) }}" 
                                alt="{{ $selectedItem->name }}" 
                                class="w-full h-full object-cover"
                            />
                        </div>
                    @endif

                    <!-- Descripción -->
                    <div>
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Descripción</h4>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            {{ $selectedItem->description }}
                        </p>
                    </div>
                    
                    {{-- AHORA MOSTRAMOS LAS FEATURES Y SPECS DE TU SEEDER --}}

                    <!-- Features -->
                    @if ($selectedItem->features->isNotEmpty())
                        <div>
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Incluye:</h4>
                            <ul class="space-y-2">
                                @foreach ($selectedItem->features->sortBy('sort_order') as $feature)
                                    <li class="flex items-start text-sm text-gray-600 dark:text-gray-400">
                                        <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>
                                        {{ $feature->text }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Specs -->
                    @if (!$showSpecs && $selectedItem->specs->isNotEmpty())
                        <div class="pt-2">
                            <button
                                type="button"
                                wire:click="toggleSpecs"
                                wire:loading.attr="disabled"
                                class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline"
                            >
                                Ver especificaciones técnicas...
                            </button>
                        </div>
                    @endif
                
                    @if ($showSpecs && $selectedItem->specs->isNotEmpty())
                        <div class="pt-2 animate-fade-in"> {{-- 'animate-fade-in' es opcional pero queda bien --}}
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Especificaciones:</h4>
                            <ul class="space-y-2 border rounded-lg p-4 dark:border-gray-600">
                                @foreach ($selectedItem->specs->sortBy('sort_order') as $spec)
                                    <li class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">{{ $spec->spec_key }}:</span>
                                        <span>{{ $spec->spec_value }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Botón de Agregar -->
                    <button
                        type="button"
                        wire:click="addToCartAndClose"
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white text-lg py-3 rounded-lg font-semibold transition duration-300"
                    >
                        Agregar a Mi Evento
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>