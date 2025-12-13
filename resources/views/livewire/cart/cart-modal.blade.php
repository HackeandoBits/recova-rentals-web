<div x-data="{
    open: false,
    requestType: '',
    submitBudget() {
        console.log('Alpine: submitBudget called');
        console.log('Items:', $store.cart.items);
        // Enviar items al backend vía Livewire
        $wire.handleSubmit($store.cart.items)
            .then(() => console.log('Livewire request sent'))
            .catch(error => console.error('Livewire error:', error));
    }
}" @open-cart-modal.window="open = true; $wire.prepareForOpen()"
    @budget-sent.window="requestType = ''; setTimeout(() => open = false, 6000)" x-init="$watch('open', value => console.log('Cart Modal Open State:', value))" x-cloak>
    <div x-show="open" x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center bg-[hsl(298,42%,15%)/0.85] backdrop-blur-md"
        @keydown.escape.window="open = false" @click.self="open = false">
        <div class="relative w-full max-w-5xl max-h-[90vh] overflow-y-auto rounded-3xl bg-[hsl(298,42%,10%)] border border-[hsl(310,75%,60%)/0.35] shadow-[0_0_40px_rgba(0,0,0,0.7)]"
            @click.stop>
            <!-- HEADER DEL MODAL -->
            <div
                class="flex items-center justify-between px-6 py-4 bg-gradient-to-r from-[hsl(298,42%,20%)] via-[hsl(298,42%,15%)] to-[hsl(310,75%,40%)] border-b border-[hsl(310,75%,60%)/0.35]">
                <div>
                    <p class="text-[0.65rem] uppercase tracking-[0.25em] text-[hsl(310,75%,85%)/0.9]">Carrito de reserva
                    </p>
                    <h3 class="text-lg font-semibold text-white">Equipos seleccionados (<span
                            x-text="$store.cart.count"></span> ítems)</h3>
                </div>
                <button type="button" @click="open = false"
                    class="inline-flex h-9 w-9 items-center justify-center rounded-full border border-white/25 text-white/80 hover:text-white hover:bg-white/10 transition">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>

            <!-- FORMULARIO PRINCIPAL -->
            <form @submit.prevent="submitBudget" class="px-6 pb-8 pt-4 md:p-8">
                <!-- Mensaje de éxito -->
                @if ($success)
                    <div class="mb-6 rounded-xl border border-emerald-500/50 bg-emerald-500/10 px-6 py-4 text-center">
                        <div class="flex justify-center mb-2"><svg class="w-10 h-10 text-emerald-400" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg></div>
                        <h4 class="text-lg font-bold text-emerald-300 mb-1">¡Solicitud Enviada!</h4>
                        <p class="text-sm text-emerald-200/80">Nos pondremos en contacto contigo a la brevedad.</p>
                        <button type="button" @click="open = false"
                            class="mt-4 text-xs font-semibold text-emerald-300 hover:text-emerald-200 underline">Cerrar
                            ventana</button>
                    </div>
                @endif

                <!-- Mensaje de error -->
                @if ($errorMessage)
                    <div
                        class="mb-4 rounded-xl border border-red-500/50 bg-red-500/10 px-4 py-3 text-sm text-red-200 flex items-center gap-3">
                        <svg class="w-5 h-5 text-red-400 flex-shrink-0" fill="none" stroke="currentColor"
                            viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        <span>{{ $errorMessage }}</span>
                    </div>
                @endif

                <div class="grid gap-8 md:grid-cols-2">
                    <!-- COLUMNA IZQUIERDA: ITEMS -->
                    <div class="space-y-4" wire:ignore>
                        <div class="flex items-center justify-between">
                            <h3 class="text-base font-semibold text-white">Equipos seleccionados</h3>
                            <button type="button" @click="$store.cart.clear()" x-show="$store.cart.items.length > 0"
                                class="text-xs font-medium text-red-400 hover:text-red-300 flex items-center gap-1.5 transition-colors duration-200 group">
                                <svg class="w-4 h-4 group-hover:scale-110 transition-transform" fill="none"
                                    stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                    </path>
                                </svg>
                                Vaciar todo
                            </button>
                        </div>
                        <div class="space-y-3 max-h-96 overflow-y-auto pr-1">
                            <template x-for="(item, index) in $store.cart.items"
                                :key="item.id ? item.id : 'item-' + index">
                                <div
                                    class="flex items-center justify-between p-3 rounded-xl border border-white/10 bg-white/5">
                                    <div class="mr-3 h-12 w-12 flex-shrink-0 overflow-hidden rounded-lg bg-gray-800"
                                        x-show="item.image_url">
                                        <img :src="item.image_url" :alt="item.name"
                                            class="h-full w-full object-cover">
                                    </div>
                                    <div class="flex-1">
                                        <h4 class="text-white font-medium text-lg" x-text="item.name"></h4>
                                        <p class="text-sm text-gray-300" x-text="item.category"></p>
                                    </div>
                                    <div class="flex items-center gap-2">
                                        <button type="button"
                                            @click="$store.cart.updateQuantity(item.id, item.quantity - 1)"
                                            class="w-6 h-6 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white">-</button>
                                        <span class="text-gray-300 text-sm font-mono" x-text="item.quantity"></span>
                                        <button type="button"
                                            @click="$store.cart.updateQuantity(item.id, item.quantity + 1)"
                                            class="w-6 h-6 rounded-full bg-white/10 hover:bg-white/20 flex items-center justify-center text-white">+</button>
                                    </div>
                                    <button type="button" @click="$store.cart.remove(item.id)"
                                        class="text-red-400 hover:text-red-300 p-2" title="Quitar"><svg class="w-5 h-5"
                                            fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                        </svg></button>
                                </div>
                            </template>
                            <p x-show="$store.cart.items.length === 0" class="text-sm text-white/60">No hay productos en
                                el carrito.</p>
                        </div>
                    </div>

                    <!-- COLUMNA DERECHA: FORMULARIO -->
                    <div class="space-y-4">
                        <h3 class="text-base font-semibold text-white">Datos del cliente</h3>
                        <!-- Nombre -->
                        <div>
                            <label for="name"
                                class="block text-xs font-medium text-white/70 uppercase tracking-wide">Nombre completo
                                *</label>
                            <input wire:model="name" id="name" type="text" placeholder="Tu nombre completo"
                                class="mt-1 block w-full rounded-lg border border-white/15 bg-black/20 text-white placeholder:text-white/40 focus:border-[hsl(310,75%,60%)] focus:ring-1 focus:ring-[hsl(310,75%,60%)] focus:outline-none text-sm px-3 py-2.5">
                            @error('name')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Email -->
                        <div>
                            <label for="email"
                                class="block text-xs font-medium text-white/70 uppercase tracking-wide">Email *</label>
                            <input wire:model="email" id="email" type="email" placeholder="tu@email.com"
                                class="mt-1 block w-full rounded-lg border border-white/15 bg-black/20 text-white placeholder:text-white/40 focus:border-[hsl(310,75%,60%)] focus:ring-1 focus:ring-[hsl(310,75%,60%)] focus:outline-none text-sm px-3 py-2.5">
                            @error('email')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Teléfono -->
                        <div>
                            <label for="phone"
                                class="block text-xs font-medium text-white/70 uppercase tracking-wide">Teléfono
                                *</label>
                            <input wire:model="phone" id="phone" type="tel" placeholder="+54 370 123-4567"
                                class="mt-1 block w-full rounded-lg border border-white/15 bg-black/20 text-white placeholder:text-white/40 focus:border-[hsl(310,75%,60%)] focus:ring-1 focus:ring-[hsl(310,75%,60%)] focus:outline-none text-sm px-3 py-2.5">
                            @error('phone')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Tipo de contacto -->
                        <div>
                            <label for="requestType"
                                class="block text-xs font-medium text-white/70 uppercase tracking-wide">Tipo de
                                contacto *</label>
                            <select x-model="requestType" wire:model="requestType" id="requestType"
                                class="mt-1 block w-full rounded-lg border border-white/15 bg-black/20 text-white focus:border-[hsl(310,75%,60%)] focus:ring-1 focus:ring-[hsl(310,75%,60%)] focus:outline-none text-sm px-3 py-2.5">
                                <option value="" class="bg-[hsl(298,42%,10%)] text-white">Seleccionar...
                                </option>
                                <option value="whatsapp" class="bg-[hsl(298,42%,10%)] text-white">Solicitar
                                    presupuesto por WhatsApp</option>
                                <option value="reunion" class="bg-[hsl(298,42%,10%)] text-white">Coordinar una reunión
                                    (virtual/física)</option>
                            </select>
                            @error('requestType')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Fecha y hora de reunión (condicional) -->
                        <div x-show="requestType === 'reunion'" x-transition class="animate-fade-in space-y-3">
                            <!-- Campo de Fecha (Flatpickr) -->
                            <div wire:ignore>
                                <label for="meetingDateOnly"
                                    class="block text-xs font-medium text-white/70 uppercase tracking-wide">
                                    Fecha deseada *
                                </label>
                                <div x-data="{
                                    picker: null,
                                    blockedDates: @js($fullyBlockedDates),
                                    init() {
                                        this.picker = flatpickr(this.$refs.input, {
                                            locale: window.flatpickrSpanish,
                                            dateFormat: 'Y-m-d',
                                            minDate: 'today',
                                            maxDate: new Date().fp_incr(365),
                                            disable: this.blockedDates,
                                            onChange: (selectedDates, dateStr) => {
                                                $wire.set('meetingDateOnly', dateStr);
                                            },
                                            onDayCreate: (dObj, dStr, fp, dayElem) => {
                                                // Format date to Y-m-d to compare
                                                const dateStr = fp.formatDate(dayElem.dateObj, 'Y-m-d');
                                                if (this.blockedDates.includes(dateStr)) {
                                                    dayElem.classList.add('admin-blocked');
                                                }
                                            }
                                        });
                                
                                        // Watch for updates from Livewire
                                        $watch('$wire.fullyBlockedDates', (value) => {
                                            this.blockedDates = Array.isArray(value) ? value : [];
                                            if (this.picker) {
                                                this.picker.set('disable', this.blockedDates);
                                                this.picker.redraw(); // Force redraw to apply classes
                                            }
                                        });
                                    }
                                }" class="mt-1">
                                    <input x-ref="input" type="text" placeholder="Seleccionar fecha..."
                                        class="block w-full rounded-lg border border-white/15 bg-black/20 text-white focus:border-[hsl(310,75%,60%)] focus:ring-1 focus:ring-[hsl(310,75%,60%)] focus:outline-none text-sm px-3 py-2.5">
                                </div>
                                @error('meetingDateOnly')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                            <!-- Campo de Hora -->
                            <div>
                                <label for="meetingTime"
                                    class="block text-xs font-medium text-white/70 uppercase tracking-wide">
                                    Horario deseado *
                                </label>

                                <div class="grid grid-cols-3 gap-2 mt-1">
                                    @if ($meetingDateOnly && !$loadingSlots)
                                        @foreach ($this->getAvailableTimeSlotsForDate() as $slotGroup => $slots)
                                            @if (count($slots) > 0)
                                                <!-- Group Label -->
                                                <div
                                                    class="col-span-3 text-xs font-medium text-white/50 uppercase tracking-wide mt-2 mb-1">
                                                    {{ $slotGroup }}
                                                </div>

                                                @foreach ($slots as $slot)
                                                    <button type="button"
                                                        wire:click="$set('meetingTime', '{{ $slot['time'] }}')"
                                                        @if ($slot['blocked']) disabled @endif
                                                        class="
                                                            relative px-3 py-2 rounded-lg text-sm font-medium transition-all duration-200 border
                                                            {{-- Blocked State --}}
                                                            @if ($slot['blocked']) bg-red-500/20 border-red-500/50 text-red-400 cursor-not-allowed opacity-80
                                                            {{-- Selected State --}}
                                                            @elseif($meetingTime === $slot['time'])
                                                                bg-[hsl(310,75%,60%)] border-[hsl(310,75%,60%)] text-white shadow-lg shadow-[hsl(310,75%,60%)]/20
                                                            {{-- Default State --}}
                                                            @else
                                                                bg-white/5 border-white/10 text-white hover:bg-white/10 hover:border-white/30 @endif
                                                        ">
                                                        {{ $slot['time'] }}
                                                        @if ($slot['blocked'])
                                                            <span class="sr-only">(Ocupado)</span>
                                                        @endif
                                                    </button>
                                                @endforeach
                                            @endif
                                        @endforeach
                                    @elseif($loadingSlots)
                                        <div class="col-span-3 text-center text-white/50 py-4">
                                            <svg class="animate-spin h-5 w-5 text-white mx-auto"
                                                xmlns="http://www.w3.org/2000/svg" fill="none"
                                                viewBox="0 0 24 24">
                                                <circle class="opacity-25" cx="12" cy="12" r="10"
                                                    stroke="currentColor" stroke-width="4"></circle>
                                                <path class="opacity-75" fill="currentColor"
                                                    d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                                </path>
                                            </svg>
                                        </div>
                                    @else
                                        <div
                                            class="col-span-3 text-center text-white/30 text-sm py-2 border border-white/10 rounded-lg bg-white/5">
                                            Selecciona una fecha primero
                                        </div>
                                    @endif
                                </div>
                                <!-- Indicador de carga -->
                                @if ($loadingSlots)
                                    <p class="text-xs text-white/60 mt-1 flex items-center gap-1">
                                        <svg class="animate-spin h-3 w-3" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 24 24">
                                            <circle class="opacity-25" cx="12" cy="12" r="10"
                                                stroke="currentColor" stroke-width="4"></circle>
                                            <path class="opacity-75" fill="currentColor"
                                                d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z">
                                            </path>
                                        </svg>
                                        Consultando disponibilidad...
                                    </p>
                                @endif
                                <!-- Mensaje si no hay horarios -->
                                @if ($meetingDateOnly && !$loadingSlots && count($this->getAvailableTimeSlotsForDate()) === 0)
                                    <p class="text-xs text-yellow-400 mt-1 flex items-center gap-1">
                                        <svg class="w-4 h-4" fill="currentColor" viewBox="0 0 20 20">
                                            <path fill-rule="evenodd"
                                                d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        No hay horarios disponibles para esta fecha. Por favor, elige otra.
                                    </p>
                                @endif
                                @error('meetingTime')
                                    <span class="text-xs text-red-400">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <!-- Notas Adicionales -->
                        <div>
                            <label for="notes"
                                class="block text-xs font-medium text-white/70 uppercase tracking-wide">Notas
                                adicionales</label>
                            <textarea wire:model="notes" id="notes" rows="3"
                                placeholder="Detalles sobre tu evento, equipos específicos, etc."
                                class="mt-1 block w-full rounded-lg border border-white/15 bg-black/20 text-white placeholder:text-white/40 focus:border-[hsl(310,75%,60%)] focus:ring-1 focus:ring-[hsl(310,75%,60%)] focus:outline-none text-sm px-3 py-2.5"></textarea>
                            @error('notes')
                                <span class="text-xs text-red-400">{{ $message }}</span>
                            @enderror
                        </div>
                        <!-- Botón de Enviar -->
                        <button type="submit"
                            class="w-full rounded-xl bg-[hsl(310,75%,60%)] px-5 py-3 text-base font-semibold text-white shadow-[0_0_20px_hsl(310,75%,40%/0.6)] hover:bg-[hsl(310,75%,55%)] hover:shadow-[0_0_25px_hsl(310,75%,60%/0.9)] focus:outline-none focus:ring-2 focus:ring-[hsl(310,75%,60%)] focus:ring-offset-2 focus:ring-offset-[hsl(298,42%,10%)] transition"
                            wire:loading.attr="disabled" wire:loading.class="opacity-70" wire:target="handleSubmit">
                            <span wire:loading.remove wire:target="handleSubmit">Enviar solicitud</span>
                            <span wire:loading wire:target="handleSubmit">Enviando...</span>
                        </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
