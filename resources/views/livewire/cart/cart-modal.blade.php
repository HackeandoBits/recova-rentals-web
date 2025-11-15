<div x-data="{ open: @entangle('isOpen') }" x-cloak>
    <div 
        x-show="open"
        x-transition.opacity
        class="fixed inset-0 z-50 flex items-center justify-center 
               bg-[hsl(298,42%,15%)/0.85] backdrop-blur-md"
        @keydown.escape.window="open = false"
        @click.self="open = false"
    >
        <div 
            class="relative w-full max-w-5xl max-h-[90vh] overflow-y-auto
                   rounded-3xl bg-[hsl(298,42%,10%)]
                   border border-[hsl(310,75%,60%)/0.35]
                   shadow-[0_0_40px_rgba(0,0,0,0.7)]"
            @click.stop
        >
            {{-- HEADER DEL MODAL --}}
            <div class="flex items-center justify-between px-6 py-4
                        bg-gradient-to-r 
                        from-[hsl(298,42%,20%)] 
                        via-[hsl(298,42%,15%)] 
                        to-[hsl(310,75%,40%)]
                        border-b border-[hsl(310,75%,60%)/0.35]">
                <div>
                    <p class="text-[0.65rem] uppercase tracking-[0.25em] 
                              text-[hsl(310,75%,85%)/0.9]">
                        Carrito de reserva
                    </p>
                    <h3 class="text-lg font-semibold text-white">
                        Equipos seleccionados ({{ count($items) }} ítems)
                    </h3>
                </div>

                {{-- Botón de Cerrar (X) --}}
                <button 
                    type="button" 
                    @click="open = false"
                    class="inline-flex h-9 w-9 items-center justify-center
                           rounded-full border border-white/25 
                           text-white/80 hover:text-white
                           hover:bg-white/10 transition"
                >
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" 
                              d="M6 18L18 6M6 6l12 12"></path>
                    </svg>
                </button>
            </div>

            {{-- FORMULARIO PRINCIPAL --}}
            <form wire:submit="handleSubmit" class="px-6 pb-8 pt-4 md:p-8">
                {{-- Mensaje de éxito --}}
                @if(session('message'))
                    <div class="mb-4 rounded-xl border border-emerald-500/50 
                                bg-emerald-500/10 px-4 py-2 text-sm text-emerald-200">
                        {{ session('message') }}
                    </div>
                @endif

                {{-- Contenido de 2 columnas --}}
                <div class="grid gap-8 md:grid-cols-2">

                    {{-- COLUMNA IZQUIERDA: ITEMS --}}
                    <div class="space-y-4">
                        <h3 class="text-base font-semibold text-white">
                            Equipos seleccionados
                        </h3>

                        <div class="space-y-3 max-h-96 overflow-y-auto pr-1">
                            @forelse ($items as $item)
                                <div class="flex items-center justify-between p-3
                                            rounded-xl border border-white/10
                                            bg-white/5">
                                    <div>
                                        <h4 class="font-medium text-white">
                                            {{ $item['name'] }}
                                        </h4>
                                        {{-- Podrías mostrar categoría o algo más si querés --}}
                                        {{-- <p class="text-xs text-white/60">{{ $item['category'] ?? '' }}</p> --}}
                                    </div>
                                    <button
                                        type="button"
                                        wire:click="removeItem({{ $item['id'] }})"
                                        class="text-red-400 hover:text-red-300 transition"
                                        title="Quitar"
                                    >
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                                  d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4
                                                     a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16">
                                            </path>
                                        </svg>
                                    </button>
                                </div>
                            @empty
                                <p class="text-sm text-white/60">
                                    No hay productos en el carrito.
                                </p>
                            @endforelse
                        </div>
                    </div>

                    {{-- COLUMNA DERECHA: FORMULARIO --}}
                    <div class="space-y-4">
                        <h3 class="text-base font-semibold text-white">
                            Datos del cliente
                        </h3>

                        {{-- Nombre --}}
                        <div>
                            <label for="name" class="block text-xs font-medium text-white/70 uppercase tracking-wide">
                                Nombre completo *
                            </label>
                            <input
                                wire:model="name"
                                id="name"
                                type="text"
                                placeholder="Tu nombre completo"
                                class="mt-1 block w-full rounded-lg border border-white/15
                                       bg-black/20 text-white placeholder:text-white/40
                                       focus:border-[hsl(310,75%,60%)]
                                       focus:ring-1 focus:ring-[hsl(310,75%,60%)]
                                       focus:outline-none text-sm px-3 py-2.5"
                            >
                            @error('name') 
                                <span class="text-xs text-red-400">{{ $message }}</span> 
                            @enderror
                        </div>

                        {{-- Email --}}
                        <div>
                            <label for="email" class="block text-xs font-medium text-white/70 uppercase tracking-wide">
                                Email *
                            </label>
                            <input
                                wire:model="email"
                                id="email"
                                type="email"
                                placeholder="tu@email.com"
                                class="mt-1 block w-full rounded-lg border border-white/15
                                       bg-black/20 text-white placeholder:text-white/40
                                       focus:border-[hsl(310,75%,60%)]
                                       focus:ring-1 focus:ring-[hsl(310,75%,60%)]
                                       focus:outline-none text-sm px-3 py-2.5"
                            >
                            @error('email') 
                                <span class="text-xs text-red-400">{{ $message }}</span> 
                            @enderror
                        </div>

                        {{-- Teléfono --}}
                        <div>
                            <label for="phone" class="block text-xs font-medium text-white/70 uppercase tracking-wide">
                                Teléfono *
                            </label>
                            <input
                                wire:model="phone"
                                id="phone"
                                type="tel"
                                placeholder="+54 370 123-4567"
                                class="mt-1 block w-full rounded-lg border border-white/15
                                       bg-black/20 text-white placeholder:text-white/40
                                       focus:border-[hsl(310,75%,60%)]
                                       focus:ring-1 focus:ring-[hsl(310,75%,60%)]
                                       focus:outline-none text-sm px-3 py-2.5"
                            >
                            @error('phone') 
                                <span class="text-xs text-red-400">{{ $message }}</span> 
                            @enderror
                        </div>

                        {{-- Tipo de contacto --}}
                        <div>
                            <label for="requestType" class="block text-xs font-medium text-white/70 uppercase tracking-wide">
                                Tipo de contacto *
                            </label>
                            <select
                                wire:model.live="requestType"
                                id="requestType"
                                class="mt-1 block w-full rounded-lg border border-white/15
                                       bg-black/20 text-white
                                       focus:border-[hsl(310,75%,60%)]
                                       focus:ring-1 focus:ring-[hsl(310,75%,60%)]
                                       focus:outline-none text-sm px-3 py-2.5"
                            >
                                <option value="" class="bg-[hsl(298,42%,10%)] text-white">
                                    Seleccionar...
                                </option>
                                <option value="whatsapp" class="bg-[hsl(298,42%,10%)] text-white">
                                    Solicitar presupuesto por WhatsApp
                                </option>
                                <option value="reunion" class="bg-[hsl(298,42%,10%)] text-white">
                                    Coordinar una reunión (virtual/física)
                                </option>
                            </select>
                            @error('requestType') 
                                <span class="text-xs text-red-400">{{ $message }}</span> 
                            @enderror
                        </div>

                        {{-- Fecha de reunión (condicional) --}}
                        @if ($requestType === 'reunion')
                            <div class="animate-fade-in">
                                <label for="meetingDate" class="block text-xs font-medium text-white/70 uppercase tracking-wide">
                                    Fecha y hora deseada *
                                </label>
                                <input
                                    wire:model="meetingDate"
                                    id="meetingDate"
                                    type="datetime-local"
                                    class="mt-1 block w-full rounded-lg border border-white/15
                                           bg-black/20 text-white
                                           focus:border-[hsl(310,75%,60%)]
                                           focus:ring-1 focus:ring-[hsl(310,75%,60%)]
                                           focus:outline-none text-sm px-3 py-2.5"
                                >
                                @error('meetingDate') 
                                    <span class="text-xs text-red-400">{{ $message }}</span> 
                                @enderror
                            </div>
                        @endif

                        {{-- Notas Adicionales --}}
                        <div>
                            <label for="notes" class="block text-xs font-medium text-white/70 uppercase tracking-wide">
                                Notas adicionales
                            </label>
                            <textarea
                                wire:model="notes"
                                id="notes"
                                rows="3"
                                placeholder="Detalles sobre tu evento, equipos específicos, etc."
                                class="mt-1 block w-full rounded-lg border border-white/15
                                       bg-black/20 text-white placeholder:text-white/40
                                       focus:border-[hsl(310,75%,60%)]
                                       focus:ring-1 focus:ring-[hsl(310,75%,60%)]
                                       focus:outline-none text-sm px-3 py-2.5"
                            ></textarea>
                            @error('notes') 
                                <span class="text-xs text-red-400">{{ $message }}</span> 
                            @enderror
                        </div>

                        {{-- Botón de Enviar --}}
                        <button 
                            type="submit"
                            class="w-full rounded-xl bg-[hsl(310,75%,60%)] px-5 py-3 
                                   text-base font-semibold text-white
                                   shadow-[0_0_20px_hsl(310,75%,40%/0.6)]
                                   hover:bg-[hsl(310,75%,55%)]
                                   hover:shadow-[0_0_25px_hsl(310,75%,60%/0.9)]
                                   focus:outline-none focus:ring-2
                                   focus:ring-[hsl(310,75%,60%)] focus:ring-offset-2
                                   focus:ring-offset-[hsl(298,42%,10%)]
                                   transition"
                            wire:loading.attr="disabled"
                            wire:loading.class="opacity-70"
                            wire:target="handleSubmit"
                        >
                            <span wire:loading.remove wire:target="handleSubmit">
                                Enviar solicitud
                            </span>
                            <span wire:loading wire:target="handleSubmit">
                                Enviando...
                            </span>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</div>
