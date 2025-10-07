<div class="max-w-3xl mx-auto p-4 space-y-3">
  @if(session('ok'))<div class="p-2 rounded bg-green-100">{{ session('ok') }}</div>@endif
  <div class="rounded-2xl border p-4 space-y-2">
    <h3 class="font-semibold">Bloquear franja</h3>
    <div class="grid md:grid-cols-3 gap-2">
      <input type="datetime-local" class="border rounded-xl p-2" wire:model.defer="start_at">
      <input type="datetime-local" class="border rounded-xl p-2" wire:model.defer="end_at">
      <input placeholder="Motivo" class="border rounded-xl p-2" wire:model.defer="reason">
    </div>
    <button wire:click="create" class="bg-black text-white rounded-xl py-2 px-4">Bloquear</button>
  </div>

  <div class="rounded-2xl border p-4">
    <h3 class="font-semibold">Bloqueos</h3>
    <ul class="space-y-2 mt-2">
      @foreach($blocks as $b)
        <li class="flex items-center justify-between border rounded-xl p-2">
          <div>
            <div class="font-medium">{{ $b->start_at }} → {{ $b->end_at }}</div>
            @if($b->reason)<div class="text-sm text-gray-500">{{ $b->reason }}</div>@endif
          </div>
          <span class="text-xs bg-gray-100 px-2 py-1 rounded">{{ $b->source }}</span>
        </li>
      @endforeach
    </ul>
  </div>
</div>