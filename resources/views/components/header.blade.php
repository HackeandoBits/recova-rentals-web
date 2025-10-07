<header class="border-b bg-white/80 backdrop-blur supports-[backdrop-filter]:bg-white/60">
<nav class="max-w-6xl mx-auto px-4 py-3 flex items-center gap-4">
<a href="/" class="font-bold text-lg">Recova</a>
<a href="{{ route('catalog') }}" class="hover:underline">Products</a>
<a href="{{ route('gallery') }}" class="hover:underline">Gallery</a>
<a href="{{ route('location') }}" class="hover:underline">Location</a>
<a href="{{ route('about') }}" class="hover:underline">About</a>
<div class="ml-auto flex items-center gap-3">
@auth
<a href="{{ route('admin.dashboard') }}" class="hover:underline">Dashboard</a>
<form method="POST" action="{{ route('logout') }}">@csrf
<button class="px-3 py-1 rounded bg-black text-white">Salir</button>
</form>
@else
<a href="{{ url('/admin/login') }}" class="px-3 py-1 rounded bg-black text-white">Ingresar</a>
@endauth
</div>
</nav>
</header>