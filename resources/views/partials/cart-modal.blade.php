<div x-data="cartStore()" x-init="init()" x-cloak>
  {{-- Overlay --}}
  <div
    class="fixed inset-0 bg-black/40 z-40"
    x-show="open"
    x-transition.opacity
    @click="open=false"
  ></div>

  {{-- Modal --}}
  <div
    class="fixed z-50 inset-x-0 top-24 mx-auto w-full max-w-lg"
    x-show="open"
    x-transition
  >
    <div class="rounded-2xl bg-white shadow-xl p-4">
      <div class="flex items-center justify-between mb-3">
        <h3 class="text-lg font-semibold">Tu carrito</h3>
        <button class="text-sm underline" @click="clear()">Vaciar</button>
      </div>

      <template x-if="items.length === 0">
        <p class="text-gray-500">No hay productos.</p>
      </template>

      <ul class="divide-y" x-show="items.length">
        <template x-for="it in items" :key="it.id">
          <li class="py-2 flex items-center justify-between">
            <div class="flex-1">
              <div class="font-medium" x-text="it.name"></div>
              <div class="text-sm text-gray-500">
                Cant: <span x-text="it.quantity"></span>
                <template x-if="it.price !== undefined">
                  <span> · $<span x-text="(it.price * it.quantity).toFixed(2)"></span></span>
                </template>
              </div>
            </div>
            <button class="text-red-600" @click="remove(it.id)">Quitar</button>
          </li>
        </template>
      </ul>

      <div class="mt-4 flex justify-end gap-2">
        <div class="text-sm text-gray-600 mr-auto">
          Total ítems: <span x-text="count()"></span>
        </div>
        <button class="px-4 py-2 rounded bg-black text-white" @click="open=false">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script>
  function cartStore() {
    return {
      open: false,
      items: [],
      init() {
        // Abrir/cerrar desde el Header
        window.addEventListener('cart:open', () => { this.open = true })
        // Agregar item (detalles: {id,name,price})
        window.addEventListener('cart:add', (e) => {
          const { id, name, price } = e.detail || {}
          if(!id) return
          const ix = this.items.findIndex(x => x.id === id)
          if (ix > -1) this.items[ix].quantity += 1
          else this.items.push({ id, name, price, quantity: 1 })
        })
        // Quitar uno
        window.addEventListener('cart:remove', (e) => {
          const { id } = e.detail || {}
          this.remove(id)
        })
        // Vaciar
        window.addEventListener('cart:clear', () => this.clear())
      },
      remove(id){ this.items = this.items.filter(x => x.id !== id) },
      clear(){ this.items = [] },
      count(){ return this.items.reduce((s, i) => s + i.quantity, 0) },
    }
  }
</script>
