<button type="button" x-data @click="$dispatch('open-cart-modal')"
    class="relative flex h-10 w-10 items-center justify-center
           rounded-2xl border border-white/15 bg-white/5
           hover:bg-white/10 transition">
    <svg class="w-5 h-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8"
        stroke-linecap="round" stroke-linejoin="round">
        <path d="M3 4h2l2 11h11l2-8H7.5" />
        <path d="M9 4h9" />
        <circle cx="10" cy="19" r="1.5" />
        <circle cx="18" cy="19" r="1.5" />
    </svg>

    <span x-show="$store.cart.count > 0" x-cloak x-transition.scale
        class="absolute -top-1 -right-1 inline-flex items-center justify-center
               rounded-full bg-pink-500 text-white text-[0.65rem]
               min-w-[1.1rem] h-[1.1rem] px-1 leading-none"
        x-text="$store.cart.count">
    </span>
</button>
