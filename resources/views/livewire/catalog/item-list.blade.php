<div class="container mx-auto px-4 pb-16" x-data="{
    items: @js($itemsJson),
    selectedItem: null,
    showModal: false,
    showSpecs: false,
    showSpecs: false,
    showPreview: false,
    previewImage: null,
    // Navigation Logic
    previewCategoryImages: [],
    previewIndex: 0,

    // Debug Mode Logic
    debugMode: false,
    dragId: null,

    toggleDebug() {
        this.debugMode = !this.debugMode;
        if (this.debugMode) alert('MODO DEBUG ACTIVADO: Arrastra los hotspots y copia el código.');
    },

    nextPreview() {
        if (!this.showPreview || this.previewCategoryImages.length === 0) return;
        this.previewIndex = (this.previewIndex + 1) % this.previewCategoryImages.length;
        this.updatePreviewImage();
    },

    prevPreview() {
        if (!this.showPreview || this.previewCategoryImages.length === 0) return;
        this.previewIndex = (this.previewIndex - 1 + this.previewCategoryImages.length) % this.previewCategoryImages.length;
        this.updatePreviewImage();
    },

    updatePreviewImage() {
        const nextImg = this.previewCategoryImages[this.previewIndex];
        this.previewImage = JSON.parse(JSON.stringify(nextImg));
        this.dragId = null;
    },

    handleDrag(e) {
        if (!this.debugMode || !this.dragId || !this.previewImage) return;

        const container = document.getElementById('preview-container');
        if (!container) return;

        const rect = container.getBoundingClientRect();

        // Calcular % con mouse relativo
        let x = ((e.clientX - rect.left) / rect.width) * 100;
        let y = ((e.clientY - rect.top) / rect.height) * 100;

        // Limites 0-100
        x = Math.max(0, Math.min(100, x));
        y = Math.max(0, Math.min(100, y));

        // Redondear
        x = Math.round(x);
        y = Math.round(y);

        const idx = this.previewImage.hotspots.findIndex(h => h.item_id === this.dragId);
        if (idx !== -1) {
            this.previewImage.hotspots[idx].x = x;
            this.previewImage.hotspots[idx].y = y;
        }
    },

    copyToClipboard() {
        if (!this.previewImage) return;
        let text = `'${this.previewImage.combo_slug}' => [\n`;
        this.previewImage.hotspots.forEach(h => {
            text += `    ['slug' => '${h.slug}', 'x' => ${h.x}, 'y' => ${h.y}],\n`;
        });
        text += `],`;

        navigator.clipboard.writeText(text).then(() => {
            alert('¡Código PHP copiado al portapapeles!');
        });
    },

    openModal(id) {
        if (this.debugMode) return; // Disable clicks in debug mode
        if (this.items[id]) {
            this.selectedItem = this.items[id];
            this.showSpecs = false;
            this.showModal = true;
        }
    },
    closeModal() {
        this.showModal = false;
        setTimeout(() => { this.selectedItem = null; }, 300);
    },
    openPreview(image, allImages = []) {
        this.previewCategoryImages = allImages;
        this.previewIndex = allImages.findIndex(img => img.id === image.id);
        if (this.previewIndex === -1) this.previewIndex = 0;

        this.updatePreviewImage();
        this.showPreview = true;
    },
    closePreview() {
        this.showPreview = false;
        this.dragId = null;
        setTimeout(() => {
            this.previewImage = null;
            this.previewCategoryImages = [];
        }, 300);
    }
}" @keydown.escape.window="closeModal(); closePreview()">
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

                                        <div class="relative w-full h-[60vh] md:h-[70vh] bg-gray-900 border border-gray-700 cursor-pointer group/image overflow-hidden"
                                            @click="openPreview(@js($image), @js($category['images']))">
                                            <img src="{{ $image['image_url'] }}" alt="{{ $image['title'] }}"
                                                class="w-full h-full object-cover transition duration-500 group-hover/image:scale-110" />
                                            <div
                                                class="absolute inset-0 bg-black/30 transition-colors duration-500 group-hover/image:bg-black/0">
                                            </div>

                                            {{-- Botón Agregar Combo (Movido dentro de la imagen) --}}
                                            <div class="absolute top-4 right-4 z-20">
                                                <button @click.stop="$store.cart.addCombo(@js($image['combo_items']))"
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
                                                <button type="button"
                                                    @click.stop="openModal({{ $hotspot['item_id'] }})"
                                                    class="absolute transform -translate-x-1/2 -translate-y-1/2 group/hotspot opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-300"
                                                    style="left: {{ $hotspot['x'] }}%; top: {{ $hotspot['y'] }}%;">
                                                    <div
                                                        class="absolute inset-0 rounded-full animate-ping bg-purple-400/50 scale-150">
                                                    </div>
                                                    <div
                                                        class="relative w-12 h-12 bg-purple-600/30 backdrop-blur-sm rounded-full border-2 border-white/30
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

                                            <div class="relative w-full h-[60vh] md:h-[70vh] bg-gray-900 border border-gray-700 cursor-pointer group/image overflow-hidden"
                                                @click="openPreview(@js($cloneImage), @js($category['images']))">
                                                <img src="{{ $cloneImage['image_url'] }}"
                                                    alt="{{ $cloneImage['title'] }}"
                                                    class="w-full h-full object-cover transition duration-500 group-hover/image:scale-105" />
                                                <div
                                                    class="absolute inset-0 bg-black/30 transition-colors duration-500 group-hover/image:bg-black/0">
                                                </div>

                                                {{-- Botón Agregar Combo (Clones) --}}
                                                <div class="absolute top-4 right-4 z-20">
                                                    <button
                                                        @click.stop="$store.cart.addCombo(@js($cloneImage['combo_items']))"
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
                                                        @click.stop="openModal({{ $hotspot['item_id'] }})"
                                                        class="absolute transform -translate-x-1/2 -translate-y-1/2 group/hotspot opacity-100 md:opacity-0 md:group-hover:opacity-100 transition-opacity duration-300"
                                                        style="left: {{ $hotspot['x'] }}%; top: {{ $hotspot['y'] }}%;">
                                                        <div
                                                            class="absolute inset-0 rounded-full animate-ping bg-purple-400/50 scale-150">
                                                        </div>
                                                        <div
                                                            class="relative w-12 h-12 bg-purple-600/30 backdrop-blur-sm rounded-full border-2 border-white/30
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
        class="fixed inset-0 bg-black/60 backdrop-blur-sm flex items-center justify-center p-4 z-[70]"
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
                    </div>
                    <div class="p-6 border-t border-white/10 flex justify-end">
                        <button type="button"
                            class="bg-gradient-to-r from-purple-600 to-pink-600 hover:from-purple-500 hover:to-pink-500 text-white font-bold py-3 px-8 rounded-full shadow-lg transform transition hover:scale-105"
                            @click="$store.cart.add({
                                id: selectedItem.id,
                                name: selectedItem.name,
                                image_url: selectedItem.image_url,
                                category: selectedItem.category_name
                            }); showModal = false">
                            Agregar a Mi Evento
                        </button>
                    </div>
                </div>
            </template>
        </div>
    </div>


    {{-- 
    ================================================================
    MODAL DE VISTA PREVIA DE IMAGEN (Full Size + Hotspots)
    ================================================================
    --}}
    <div x-show="showPreview" style="display: none;"
        class="fixed inset-0 bg-black/90 backdrop-blur-md flex items-center justify-center z-[60]" x-transition.opacity
        @click="closePreview()" @keydown.window.alt.d.prevent="toggleDebug()"
        @keydown.window.arrow-right.prevent="nextPreview()" @keydown.window.arrow-left.prevent="prevPreview()"
        @mousemove.window="handleDrag($event)" @mouseup.window="dragId = null">

        {{-- DEBUG PANEL --}}
        <div x-show="debugMode"
            class="fixed top-4 left-4 bg-black/80 text-white p-4 rounded-lg z-[100] w-64 text-xs font-mono"
            @click.stop>
            <h3 class="font-bold border-b border-gray-600 mb-2 pb-1">MODO DEBUG (Alt+D)</h3>
            <p class="mb-2 text-gray-400">Arrastra los puntos y copia:</p>

            <template x-if="previewImage">
                <div class="space-y-1 mb-3">
                    <template x-for="hotspot in previewImage.hotspots" :key="hotspot.item_id">
                        <div class="flex justify-between hover:bg-white/10 p-1 rounded">
                            <span x-text="hotspot.slug.substring(0,10) + '...'"></span>
                            <span>x:<span x-text="hotspot.x" class="text-green-400"></span> y:<span
                                    x-text="hotspot.y" class="text-yellow-400"></span></span>
                        </div>
                    </template>
                </div>
            </template>

            <button @click="copyToClipboard()"
                class="w-full bg-purple-600 hover:bg-purple-700 py-2 rounded text-white font-bold transition">
                COPIAR PHP ARRAY
            </button>
            <div class="mt-2 text-center text-gray-500 text-[10px]">
                Recargar página pierdes cambios.
            </div>
        </div>

        <div class="relative w-full h-full flex items-center justify-center p-4">
            {{-- Botón Cerrar --}}
            <button type="button" @click="closePreview()"
                class="absolute top-4 right-4 z-50 p-2 bg-black/50 text-white rounded-full hover:bg-white/20 transition">
                <svg class="w-8 h-8" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12">
                    </path>
                </svg>
            </button>

            <!-- Flecha Izquierda -->
            <button type="button" @click.stop="prevPreview()"
                class="absolute left-4 top-1/2 -translate-y-1/2 z-50 p-3 bg-black/50 text-white/70 rounded-full hover:bg-white/20 hover:text-white transition">
                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                </svg>
            </button>

            <!-- Flecha Derecha -->
            <button type="button" @click.stop="nextPreview()"
                class="absolute right-4 top-1/2 -translate-y-1/2 z-50 p-3 bg-black/50 text-white/70 rounded-full hover:bg-white/20 hover:text-white transition">
                <svg class="w-8 h-8 md:w-10 md:h-10" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                </svg>
            </button>

            <template x-if="previewImage">
                <div id="preview-container" class="relative inline-block max-w-full max-h-screen select-none"
                    @click.stop>
                    <img :src="previewImage.image_url" :alt="previewImage.title"
                        class="max-w-full max-h-[90vh] object-contain rounded-lg shadow-2xl pointer-events-none" />

                    {{-- Botón Agregar Combo (En Preview) --}}
                    <div class="absolute top-4 right-4 z-50">
                        <button @click.stop="$store.cart.addCombo(previewImage.combo_items)"
                            class="bg-purple-600 hover:bg-purple-700 text-white text-xs font-bold py-2 px-4 rounded-full shadow-lg transition transform hover:scale-105 flex items-center gap-2"
                            title="Agregar todos los items de este combo">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Agregar Combo
                        </button>
                    </div>

                    {{-- Hotspots en Preview --}}
                    <template x-for="hotspot in previewImage.hotspots" :key="hotspot.item_id">
                        <button type="button" @click="openModal(hotspot.item_id)"
                            @mousedown.prevent.stop="if(debugMode) { dragId = hotspot.item_id; }"
                            class="absolute transform -translate-x-1/2 -translate-y-1/2 group/hotspot transition-none"
                            :class="{ 'cursor-move z-50': debugMode, 'cursor-pointer': !debugMode }"
                            :style="`left: ${hotspot.x}%; top: ${hotspot.y}%;`">

                            <div class="absolute inset-0 rounded-full animate-ping bg-purple-400/50 scale-150"
                                x-show="!debugMode">
                            </div>

                            <div class="relative w-10 h-10 md:w-14 md:h-14 backdrop-blur-sm rounded-full border-2 
                                        flex items-center justify-center text-white shadow-lg transition-all duration-300"
                                :class="debugMode ? 'bg-red-600/50 border-red-400' :
                                    'bg-purple-600/30 border-white/30 hover:scale-110'">
                                <svg class="w-5 h-5 md:w-8 md:h-8" fill="none" stroke="currentColor"
                                    viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>

                                {{-- Debug Coords --}}
                                <div x-show="debugMode"
                                    class="absolute -top-6 left-1/2 -translate-x-1/2 text-[10px] bg-black text-white px-1 rounded whitespace-nowrap">
                                    <span x-text="hotspot.x"></span>,<span x-text="hotspot.y"></span>
                                </div>
                            </div>
                            <div class="absolute top-full left-1/2 transform -translate-x-1/2 mt-2 px-3 py-1 
                                        bg-black/80 backdrop-blur-sm text-white text-sm 
                                        rounded-lg opacity-0 group-hover/hotspot:opacity-100 
                                        transition-opacity duration-300 whitespace-nowrap pointer-events-none"
                                x-show="!debugMode">
                                <span x-text="hotspot.name"></span>
                            </div>
                        </button>
                    </template>
                </div>
            </template>
        </div>
    </div>
</div>
