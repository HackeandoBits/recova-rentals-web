<div class="max-w-5xl mx-auto p-4 space-y-4">
    <div class="flex gap-2">
        <input wire:model.debounce.300ms="q" class="border rounded-xl p-2 w-full" placeholder="Buscar...">
    </div>
    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
        @foreach ($items as $it)
            <div class="rounded-2xl shadow p-3 flex flex-col justify-between">
                {{-- PARTE DE LA IMAGEN Y TÍTULO (ya la tenías) --}}
                <div>
                    @php
                        $img = null;
                        if (method_exists($it, 'images') && $it->relationLoaded('images') && $it->images) {
                            $img = $it->images->firstWhere('is_primary', true) ?? $it->images->first();
                        }
                        $url = $img?->url ?? asset('img/placeholder.webp');
                    @endphp

                    <img src="{{ $url }}" alt="{{ $it->name }}"
                        class="rounded-xl w-full aspect-video object-cover">

                    <div class="mt-2">
                        <h3 class="font-semibold">{{ $it->name }}</h3>
                        <p class="text-sm text-gray-500 line-clamp-2">{{ $it->description }}</p>
                    </div>
                </div>

                {{-- 👇 ESTE ES EL BOTÓN NUEVO QUE AGREGA AL CARRITO 👇 --}}
                <div class="mt-4">
                    <button 
                        {{-- 
                          Dispara un evento 'add-to-cart' que CUALQUIER 
                          componente (el CartManager) puede escuchar.
                        --}}
                        wire:click="$dispatch('add-to-cart', { itemId: {{ $it->id }} })"
                        type="button"
                        class="w-full rounded-lg bg-blue-600 px-4 py-2 text-sm font-medium text-white hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2"
                    >
                        Agregar a Selección
                    </button>
                </div>
            </div>
        @endforeach
    </div>
    {{ $items->links() }}
</div>
