<div class="container mx-auto px-4 pb-16" x-data="{
    items: @entangle('itemsJson'),
    selectedItem: null,
    showModal: false,
    showSpecs: false,
    openModal(id) {
        if (this.items[id]) {
            this.selectedItem = this.items[id];
            this.showSpecs = false;
            this.showModal = true;
        }
    },
    closeModal() {
        this.showModal = false;
        // Delay clearing selectedItem slightly to avoid UI flicker during transition
        setTimeout(() => { this.selectedItem = null; }, 300);
    },
    addToCart() {
        if (this.selectedItem) {
            $wire.addToCart(this.selectedItem.id);
            this.closeModal();
        }
    }
}" @keydown.escape.window="closeModal()">
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

                                            {{-- Botón Agregar Combo (Movido dentro de la imagen) --}}
                                            <div class="absolute top-4 right-4 z-20">
                                                <button
                                                    @click="Livewire.dispatch('add-combo', { comboSlug: '{{ $image['combo_slug'] }}' })"
                                                    class="bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold py-2 px-4 rounded-full shadow-lg transition transform hover:scale-105 flex items-center gap-2"
                                                    title="Agregar todos los items de este combo">
                                                    <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                        viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round"
                                                            stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                    </svg>
                                                    Agregar Combo
                                                </button>
                                            </div>

                                            @foreach ($image['hotspots'] as $hotspot)
                                                <button type="button" @click="openModal({{ $hotspot['item_id'] }})"
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

                                                {{-- Botón Agregar Combo (Clones) --}}
                                                <div class="absolute top-4 right-4 z-20">
                                                    <button
                                                        @click="Livewire.dispatch('add-combo', { comboSlug: '{{ $cloneImage['combo_slug'] }}' }); $dispatch('add-to-cart-count', { amount: {{ $cloneImage['combo_count'] }} })"
                                                        class="bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold py-2 px-4 rounded-full shadow-lg transition transform hover:scale-105 flex items-center gap-2"
                                                        title="Agregar todos los items de este combo">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor"
                                                            viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                                stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                                        </svg>
                                                        Agregar Combo
                                                    </button>
                                                </div>

                                                @foreach ($cloneImage['hotspots'] as $hotspot)
                                                    <button type="button"
                                                        @click="openModal({{ $hotspot['item_id'] }})"
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
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5l7 7-7 7">
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
    PANEL DE DETALLE DEL HOTSPOT (Modal) - (ALPINE JS)
    ================================================================
    --}}
    <div x-show="showModal" style="display: none;"
        class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 z-50"
        x-transition.opacity @click="closeModal()">

        <div class="bg-white dark:bg-gray-800 border border-gray-700 rounded-2xl max-w-md w-full max-h-[90vh] overflow-y-auto"
            @click.stop x-show="showModal" x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95" x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200" x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95">

            <template x-if="selectedItem">
                <div>
                    <div class="relative p-6 border-b border-gray-200 dark:border-gray-700">
                        <button type="button" @click="closeModal()"
                            class="absolute top-4 right-4 text-gray-400 hover:text-gray-600">
                            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M6 18L18 6M6 6l12 12"></path>
                            </svg>
                        </button>

                        <div>
                            {{-- Muestra la categoría real de la BBDD --}}
                            <span class="text-sm font-medium text-purple-600 dark:text-purple-400"
                                x-text="selectedItem.category_name"></span>
                            <h3 class="text-2xl font-bold text-gray-900 dark:text-white mt-1"
                                x-text="selectedItem.name"></h3>
                        </div>
                    </div>

                    <div class="p-6 space-y-6">
                        <div class="h-48 rounded-xl overflow-hidden bg-gray-200 dark:bg-gray-700"
                            x-show="selectedItem.image_url">
                            <img :src="selectedItem.image_url" :alt="selectedItem.name"
                                class="w-full h-full object-cover" />
                        </div>

                        <div>
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-2">Descripción</h4>
                            <p class="text-gray-600 dark:text-gray-400 leading-relaxed"
                                x-text="selectedItem.description"></p>
                        </div>

                        <div x-show="selectedItem.features && selectedItem.features.length > 0">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Incluye:</h4>
                            <ul class="space-y-2">
                                <template x-for="feature in selectedItem.features" :key="feature.id">
                                    <li class="flex items-start text-sm text-gray-600 dark:text-gray-400">
                                        <svg class="w-4 h-4 text-green-500 mr-2 mt-0.5 flex-shrink-0" fill="none"
                                            stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M5 13l4 4L19 7"></path>
                                        </svg>
                                        <span x-text="feature.text"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <div x-show="!showSpecs && selectedItem.specs && selectedItem.specs.length > 0"
                            class="pt-2">
                            <button type="button" @click="showSpecs = true"
                                class="text-sm font-medium text-purple-600 dark:text-purple-400 hover:underline">
                                Ver especificaciones técnicas...
                            </button>
                        </div>

                        <div x-show="showSpecs && selectedItem.specs && selectedItem.specs.length > 0"
                            class="pt-2 animate-fade-in">
                            <h4 class="font-semibold text-gray-700 dark:text-gray-300 mb-3">Especificaciones:</h4>
                            <ul class="space-y-2 border rounded-lg p-4 dark:border-gray-600">
                                <template x-for="spec in selectedItem.specs" :key="spec.id">
                                    <li class="flex justify-between text-sm text-gray-600 dark:text-gray-400">
                                        <span class="font-medium text-gray-700 dark:text-gray-300"
                                            x-text="spec.spec_key + ':'"></span>
                                        <span x-text="spec.spec_value"></span>
                                    </li>
                                </template>
                            </ul>
                        </div>

                        <button type="button" @click="addToCart()"
                            class="w-full bg-purple-600 hover:bg-purple-700 text-white text-lg py-3 rounded-lg font-semibold transition duration-300">
                            Agregar a Mi Evento
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>
</div>
