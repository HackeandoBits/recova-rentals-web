<header class="border-b border-border bg-card/90 backdrop-blur sticky top-0 z-50">
</nav>


{{-- Carrito (Alpine) --}}
<div class="ml-auto" x-data="cart()">
<button @click="open=true" class="relative px-3 py-1 rounded bg-muted hover:bg-muted/80">
Carrito
<span class="absolute -top-2 -right-2 text-xs rounded-full bg-primary text-primary-foreground px-1.5" x-text="count()"></span>
</button>


{{-- Modal --}}
<div x-show="open" x-transition.opacity class="fixed inset-0 bg-black/40 grid place-items-center p-4" @click.self="open=false">
<div class="w-full max-w-lg rounded-2xl bg-card text-card-foreground shadow-xl p-4">
<div class="flex items-center justify-between mb-3">
<h3 class="text-lg font-semibold">Tu carrito</h3>
<button class="text-sm hover:underline" @click="clear()">Vaciar</button>
</div>
<template x-if="items.length === 0">
<p class="text-muted-foreground">No hay productos.</p>
</template>
<ul class="divide-y" x-show="items.length">
<template x-for="it in items" :key="it.id">
<li class="py-2 flex items-center justify-between">
<div class="flex-1">
<div class="font-medium" x-text="it.name"></div>
<div class="text-sm text-muted-foreground">Cant: <span x-text="it.quantity"></span></div>
</div>
<button class="text-red-600" @click="remove(it.id)">Quitar</button>
</li>
</template>
</ul>
<div class="mt-4 flex justify-end">
<button class="px-4 py-2 rounded bg-primary text-primary-foreground" @click="open=false">Cerrar</button>
</div>
</div>
</div>
</div>
</div>
</header>


<script>
function cart(){
return {
open:false,
items: [],
add(item){
const idx = this.items.findIndex(x=>x.id===item.id)
if(idx>-1){ this.items[idx].quantity++; }
else { this.items.push({...item, quantity:1}); }
},
remove(id){ this.items = this.items.filter(x=>x.id!==id) },
clear(){ this.items = [] },
count(){ return this.items.reduce((s,i)=>s+i.quantity,0) }
}
}
</script>