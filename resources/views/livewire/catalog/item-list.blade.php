<div class="max-w-5xl mx-auto p-4 space-y-4">
  <div class="flex gap-2">
    <input wire:model.debounce.300ms="q" class="border rounded-xl p-2 w-full" placeholder="Buscar...">
    <a href="{{ route('bookings.create') }}" class="px-4 py-2 rounded-xl bg-black text-white">Nueva reserva</a>
  </div>
  <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-4">
    @foreach($items as $it)
      <div class="rounded-2xl shadow p-3">
        @php $img = $it->images->firstWhere('is_primary', true) ?? $it->images->first(); @endphp
        @if($img)
          <img src="{{ $img->url }}" alt="{{ $it->name }}" class="rounded-xl w-full aspect-video object-cover" />
        @endif
        <div class="mt-2 flex items-start justify-between">
          <div>
            <h3 class="font-semibold">{{ $it->name }}</h3>
            <p class="text-sm text-gray-500 line-clamp-2">{{ $it->description }}</p>
          </div>
        </div>
      </div>
    @endforeach
  </div>
  {{ $items->links() }}
</div>