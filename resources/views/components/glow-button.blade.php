<span {{ $attributes->merge(['class' => 'px-5 py-2 border border-pink-500 text-pink-400 rounded-full text-sm font-medium
    transition duration-300 hover:shadow-[0_0_20px_4px_rgba(230,76,204,0.7)] hover:ring-0 hover:scale-[1.02] hover:text-white']) }}>
    {{ $slot }}
</span>
