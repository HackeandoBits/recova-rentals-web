<div class="container mx-auto px-4 pb-16" x-data @keydown.escape.window="$wire.closePanel()">
    {{-- Intro moderna con menos espaciado --}}
    <div class="text-center mb-8 mt-4 animate-fade-in-down">
        <h2
            class="text-2xl md:text-3xl font-bold bg-clip-text text-transparent bg-gradient-to-r from-purple-600 to-pink-600 mb-2">
            Explora Nuestros Combos
        </h2>
        <p class="text-lg md:text-xl text-gray-600 dark:text-gray-300 max-w-3xl mx-auto leading-relaxed">
            Haz clic en los <span class="font-semibold text-purple-600 dark:text-purple-400">puntos interactivos</span>
            para descubrir nuestros equipos y armar tu evento ideal.
        </p>
    </div>

    <div class="space-y-12">
        {{-- 1. BUCLE DE CATEGORÍAS --}}
        @foreach ($imageCategories as $category)
            <div key="{{ $category['id'] }}" class="space-y-4">
                {{-- Títulos eliminados por solicitud del usuario --}}

                {{-- 
                ================================================================
                👇 INICIO: CONTENEDOR DEL CARRUSEL (LOOP INFINITO EN UN SOLO SENTIDO)
                ================================================================
                --}}
                <div class="relative" x-data="{
                    currentSlide: 0,
                    totalSlides: {{ count($category['images']) }},
                    itemsVisible: 1,
                    timer: null,
                    isPlaying: true,
                    isTransitioning: true,
                
                    init() {
                        this.updateItemsVisible();
                        window.addEventListener('resize', () => this.updateItemsVisible());
                        this.startTimer();
                    },
                
                    updateItemsVisible() {
                        this.itemsVisible = window.innerWidth >= 768 ? 3 : 1;
                    },
                
                    next() {
                        if (this.currentSlide >= this.totalSlides) return;
                        this.currentSlide++;
                    },
                
                    prev() {
                        this.isPlaying = false;
                        this.stopTimer();
                
                        if (this.currentSlide === 0) {
                            this.isTransitioning = false;
                            this.currentSlide = this.totalSlides;
                            this.$nextTick(() => {
                                requestAnimationFrame(() => {
                                    this.isTransitioning = true;
                                    this.currentSlide = this.totalSlides - 1;
                                });
                            });
                        } else {
                            this.currentSlide--;
                        }
                    },
                
                    startTimer() {
                        if (this.totalSlides <= this.itemsVisible || !this.isPlaying) return;
                        clearInterval(this.timer);
                        this.timer = setInterval(() => { this.next() }, 5000);
                    },
                
                    stopTimer() {
                        clearInterval(this.timer);
                    },
                
                    clickNext() {
                        this.isPlaying = false;
                        this.stopTimer();
                        this.next();
                    },
                
                    clickPrev() {
                        this.prev();
                    },
                
                    handleTransitionEnd() {
                        if (this.currentSlide >= this.totalSlides) {
                            this.isTransitioning = false;
                            this.currentSlide = 0;
                            this.$nextTick(() => {
                                requestAnimationFrame(() => {
                                    this.isTransitioning = true;
                                });
                            });
                        }
                    }
                }" x-init="init()" @mouseenter="stopTimer()"
                    @mouseleave="startTimer()">
                    {{-- 1. Máscara --}}
                    <div class="overflow-hidden rounded-2xl relative">
                        {{-- 2. Track --}}
                        <div class="flex"
                            :style="`
                                                                                        transform: translateX(-${currentSlide * (100 / itemsVisible)}%);
                                                                                        transition: ${isTransitioning ? 'transform 500ms ease-in-out' : 'none'};
                                                                                    `"
                            @transitionend="handleTransitionEnd()">
                            {{-- 3. Slides reales --}}
                            @foreach ($category['images'] as $image)
                                <div class="w-full md:w-1/3 flex-shrink-0">
                                    <div key="{{ $image['id'] }}" class="relative group">
                                        <h4
                                            class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 text-center">
                                            {{ $image['title'] }}
                                        </h4>

                                        <div
                                            class="relative w-full h-[60vh] md:h-[70vh] bg-gray-900 border border-gray-700">
                                            <img src="{{ $image['image_url'] }}" alt="{{ $image['title'] }}"
                                                class="w-full h-full object-cover" />
                                            <div class="absolute inset-0 bg-black/30"></div>

                                            @foreach ($image['hotspots'] as $hotspot)
                                                <button type="button"
                                                    wire:click="selectItem({{ $hotspot['item_id'] }})"
                                                    class="absolute transform -translate-x-1/2 -translate-y-1/2 group/hotspot"
                                                    style="left: {{ $hotspot['x'] }}%; top: {{ $hotspot['y'] }}%;">
                                                    <div
                                                        class="absolute inset-0 rounded-full animate-ping bg-purple-400/50 scale-150">
                                                    </div>
                                                    <div
                                                        class="relative w-12 h-12 bg-purple-600/90 backdrop-blur-sm rounded-full border-2 border-white/30
                                                                flex items-center justify-center text-white shadow-lg
                                                                group-hover/hotspot:scale-110 transition-all duration-300">
                                                        <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                                        </svg>
                                                    </div>
                                                    <div
                                                        class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 px-3 py-1 
                                                                bg-black/80 backdrop-blur-sm text-white text-sm 
                                                                rounded-lg opacity-0 group-hover/hotspot:opacity-100 
                                                                transition-opacity duration-300 whitespace-nowrap pointer-events-none">
                                                        {{ $hotspot['name'] }}
                                                    </div>
                                                </button>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach

                            {{-- 4. Slides CLONADOS (para loop infinito) --}}
                            @if (count($category['images']) > 0)
                                @foreach (array_slice($category['images'], 0, 3) as $cloneImage)
                                    <div class="w-full md:w-1/3 flex-shrink-0">
                                        <div class="relative group">
                                            <h4
                                                class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 text-center">
                                                {{ $cloneImage['title'] }}
                                            </h4>

                                            <div
                                                class="relative w-full h-[60vh] md:h-[70vh] bg-gray-900 border border-gray-700">
                                                <img src="{{ $cloneImage['image_url'] }}"
                                                    alt="{{ $cloneImage['title'] }}"
                                                    class="w-full h-full object-cover" />
                                                <div class="absolute inset-0 bg-black/30"></div>

                                                @foreach ($cloneImage['hotspots'] as $hotspot)
                                                    <button type="button"
                                                        wire:click="selectItem({{ $hotspot['item_id'] }})"
                                                        class="absolute transform -translate-x-1/2 -translate-y-1/2 group/hotspot"
                                                        style="left: {{ $hotspot['x'] }}%; top: {{ $hotspot['y'] }}%;">
                                                        <div
                                                            class="absolute inset-0 rounded-full animate-ping bg-purple-400/50 scale-150">
                                                        </div>
                                                        <div
                                                            class="relative w-12 h-12 bg-purple-600/90 backdrop-blur-sm rounded-full border-2 border-white/30
                                                                    flex items-center justify-center text-white shadow-lg
                                                                    group-hover/hotspot:scale-110 transition-all duration-300">
                                                            <svg class="w-6 h-6" fill="none" stroke="currentColor"
                                                                viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round"
                                                                    stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z">
                                                                </path>
                                                            </svg>
                                                        </div>
                                                        <div
                                                            class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 px-3 py-1 
                                                                    bg-black/80 backdrop-blur-sm text-white text-sm 
                                                                    rounded-lg opacity-0 group-hover/hotspot:opacity-100 
                                                                    transition-opacity duration-300 whitespace-nowrap pointer-events-none">
                                                            {{ $hotspot['name'] }}
                                                        </div>
                                                    </button>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>

                    {{-- Flechas --}}
                    @if (count($category['images']) > 1)
                        <button type="button" @click="clickPrev()"
                            class="absolute left-2 md:left-4 top-1/2 -translate-y-1/2 z-10 p-2 bg-black/30 rounded-full text-white/70 hover:text-white hover:bg-black/50 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M15 19l-7-7 7-7"></path>
                            </svg>
                        </button>
                        <button type="button" @click="clickNext()"
                            class="absolute right-2 md:right-4 top-1/2 -translate-y-1/2 z-10 p-2 bg-black/30 rounded-full text-white/70 hover:text-white hover:bg-black/50 transition">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7">
                                </path>
                            </svg>
                        </button>
                    @endif
                </div>
                {{-- 👆 FIN: CONTENEDOR DEL CARRUSEL --}}
            </div>
        @endforeach
    </div>

    {{-- 
    ================================================================
    PANEL DE DETALLE DEL HOTSPOT (Modal) - (COMPLETO)
    ================================================================
    --}}
    @if ($showDetailPanel && $selectedItem)
        <div class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 z-50"
            @click="$wire.closePanel()">
            <div class="bg-white dark:bg-gray-800 border border-gray-700 rounded-2xl max-w-md w-full max-h-[90vh] overflow-y-auto"
                @click.stop>
                <div class="relative p-6 border-b border-gray-200 dark:border-gray-700">
                    <button type="button" wire:click="closePanel"
                        class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
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

                <div class="p-6 space-y-6">
                    @if ($selectedItem->image_url)
                        <div class="h-48 rounded-xl overflow-hidden bg-gray-200 dark:bg-gray-700">
                            <img src="{{ Str::startsWith($selectedItem->image_url, ['http', 'https']) ? $selectedItem->image_url : asset($selectedItem->image_url) }}"
                                alt="{{ $selectedItem->name }}" class="w-full h-full object-cover" />
                        </div>
                    @endif

                    <div>
                        <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Descripción</h4>
                        <p class="text-gray-600 dark:text-gray-400 leading-relaxed">
                            {{ $selectedItem->description }}
                        </p>
                    </div>

                    @if ($selectedItem->features->isNotEmpty())
                        <div>
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Incluye:</h4>
                            <ul class="space-y-2">
                                @foreach ($selectedItem->features->sortBy('sort_order') as $feature)
                                    <li class="flex items-start text-sm text-gray-600 dark:text-gray-400">
                                        <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        {{ $feature->text }}
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    @if (!$showSpecs && $selectedItem->specs->isNotEmpty())
                        <div class="pt-2">
                            <button type="button" wire:click="toggleSpecs" wire:loading.attr="disabled"
                                class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline">
                                Ver especificaciones técnicas...
                            </button>
                        </div>
                    @endif

                    @if ($showSpecs && $selectedItem->specs->isNotEmpty())
                        <div class="pt-2 animate-fade-in">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Especificaciones:</h4>
                            <ul class="space-y-2 border rounded-lg p-4 dark:border-gray-600">
                                @foreach ($selectedItem->specs->sortBy('sort_order') as $spec)
                                    <li class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                        <span class="font-medium text-gray-700 dark:text-gray-300">
                                            {{ $spec->spec_key }}:
                                        </span>
                                        <span>{{ $spec->spec_value }}</span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <button type="button" wire:click="addToCartAndClose"
                        class="w-full bg-purple-600 hover:bg-purple-700 text-white text-lg py-3 rounded-lg font-semibold transition duration-300">
                        Agregar a Mi Evento
                    </button>
                </div>
            </div>
        </div>
    @endif
</div>
