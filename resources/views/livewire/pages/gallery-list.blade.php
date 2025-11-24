<div class="container mx-auto px-4 py-12" x-data="{ selected: null, open: false }">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
        @foreach ($events as $index => $event)
            <div class="group relative bg-zinc-900/50 backdrop-blur-sm rounded-2xl overflow-hidden cursor-pointer border border-zinc-800 hover:border-purple-500/50 transition-all duration-500 hover:shadow-[0_0_30px_rgba(168,85,247,0.15)]"
                @click="selected = {{ json_encode($event) }}; open = true"
                style="animation: fadeIn 0.5s ease-out {{ $index * 0.1 }}s backwards;">
                <!-- Image Container -->
                <div class="aspect-video overflow-hidden relative">
                    <img src="{{ $event['image'] }}" alt="{{ $event['title'] }}"
                        class="w-full h-full object-cover transform group-hover:scale-110 transition-all duration-700">
                    <div
                        class="absolute inset-0 bg-gradient-to-t from-black/90 via-black/20 to-transparent opacity-80 group-hover:opacity-60 transition-opacity duration-500">
                    </div>

                    <div class="absolute top-4 right-4">
                        <span
                            class="bg-black/40 backdrop-blur-md text-white text-xs font-medium px-3 py-1 rounded-full border border-white/10 shadow-lg">
                            {{ $event['category'] }}
                        </span>
                    </div>

                    <!-- Overlay Content (Visible on Hover/Always visible at bottom) -->
                    <div
                        class="absolute bottom-0 left-0 right-0 p-6 transform translate-y-2 group-hover:translate-y-0 transition-transform duration-500">
                        <h3
                            class="text-xl font-bold text-white mb-2 group-hover:text-purple-400 transition-colors duration-300">
                            {{ $event['title'] }}
                        </h3>
                        <div
                            class="flex items-center text-zinc-400 text-sm opacity-0 group-hover:opacity-100 transition-opacity duration-500 delay-100">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2 text-purple-500" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                            </svg>
                            {{ $event['date'] }}
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <style>
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
    </style>

    <!-- Modal -->
    <div x-show="open" style="display: none;" class="fixed inset-0 z-50 overflow-y-auto" aria-labelledby="modal-title"
        role="dialog" aria-modal="true">
        <!-- Backdrop -->
        <div x-show="open" x-transition:enter="ease-out duration-300" x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100" x-transition:leave="ease-in duration-200"
            x-transition:leave-start="opacity-100" x-transition:leave-end="opacity-0"
            class="fixed inset-0 bg-black/90 transition-opacity backdrop-blur-sm" @click="open = false"></div>

        <!-- Modal Panel -->
        <div class="flex min-h-full items-center justify-center p-4 text-center sm:p-0">
            <div x-show="open" x-transition:enter="ease-out duration-300"
                x-transition:enter-start="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave="ease-in duration-200"
                x-transition:leave-start="opacity-100 translate-y-0 sm:scale-100"
                x-transition:leave-end="opacity-0 translate-y-4 sm:translate-y-0 sm:scale-95"
                class="relative transform overflow-hidden rounded-2xl bg-zinc-900 border border-zinc-800 text-left shadow-xl transition-all sm:my-8 sm:w-full sm:max-w-4xl">
                <div class="absolute right-4 top-4 z-10">
                    <button @click="open = false" type="button"
                        class="rounded-full bg-black/50 p-2 text-zinc-400 hover:text-white hover:bg-black/70 transition-all focus:outline-none">
                        <svg class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                            stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                        </svg>
                    </button>
                </div>

                <template x-if="selected">
                    <div class="flex flex-col md:flex-row">
                        <!-- Image Section -->
                        <div class="w-full md:w-1/2 h-64 md:h-auto relative">
                            <img :src="selected.image" :alt="selected.title"
                                class="absolute inset-0 w-full h-full object-cover">
                            <div
                                class="absolute bottom-0 left-0 right-0 bg-gradient-to-t from-zinc-900 to-transparent h-24">
                            </div>
                        </div>

                        <!-- Content Section -->
                        <div class="w-full md:w-1/2 p-8">
                            <div class="mb-6">
                                <span
                                    class="inline-block px-3 py-1 rounded-full text-xs font-semibold bg-violet-500/10 text-violet-400 border border-violet-500/20 mb-4"
                                    x-text="selected.category"></span>
                                <h2 class="text-3xl font-bold text-white mb-2" x-text="selected.title"></h2>
                                <div class="flex items-center text-zinc-400 space-x-4 text-sm">
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <span x-text="selected.date"></span>
                                    </div>
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 mr-2" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                                        </svg>
                                        <span x-text="selected.location"></span>
                                    </div>
                                </div>
                            </div>

                            <div class="prose prose-invert mb-8">
                                <p class="text-zinc-300 leading-relaxed" x-text="selected.description"></p>
                            </div>

                            <div>
                                <h4 class="text-sm font-semibold text-white uppercase tracking-wider mb-4">Equipamiento
                                    Utilizado</h4>
                                <ul class="space-y-2">
                                    <template x-for="item in selected.equipment" :key="item">
                                        <li class="flex items-center text-zinc-400 text-sm">
                                            <svg class="h-4 w-4 mr-3 text-violet-500" fill="none"
                                                viewBox="0 0 24 24" stroke="currentColor">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                    d="M5 13l4 4L19 7" />
                                            </svg>
                                            <span x-text="item"></span>
                                        </li>
                                    </template>
                                </ul>
                            </div>
                        </div>
                    </div>
                </template>
            </div>
        </div>
    </div>
</div>
