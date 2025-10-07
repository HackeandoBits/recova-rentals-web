<div class="max-w-xl mx-auto p-4 space-y-3">
  @if(session('ok'))<div class="p-2 rounded bg-green-100">{{ session('ok') }}</div>@endif
  <form wire:submit.prevent="submit" class="grid gap-2">
    <label class="text-sm">Cliente ID</label>
    <input type="number" class="border rounded-xl p-2" wire:model.defer="form.customer_id">

    <label class="text-sm">Inicio</label>
    <input type="datetime-local" class="border rounded-xl p-2" wire:model.defer="form.start_at">

    <label class="text-sm">Fin</label>
    <input type="datetime-local" class="border rounded-xl p-2" wire:model.defer="form.end_at">

    <label class="text-sm">Método</label>
    <select class="border rounded-xl p-2" wire:model.defer="form.delivery_method">
      <option value="pickup">Retiro</option>
      <option value="delivery">Envío</option>
    </select>

    <label class="text-sm">Dirección (opcional)</label>
    <input type="number" class="border rounded-xl p-2" wire:model.defer="form.address_id">

    <label class="text-sm">Total pactado</label>
    <input type="number" step="0.01" class="border rounded-xl p-2" wire:model.defer="form.agreed_total">

    <label class="text-sm">Seña</label>
    <input type="number" step="0.01" class="border rounded-xl p-2" wire:model.defer="form.deposit_paid">

    <label class="text-sm">Notas</label>
    <textarea class="border rounded-xl p-2 min-h-24" wire:model.defer="form.notes"></textarea>

    <button class="mt-2 bg-black text-white rounded-xl py-2">Crear reserva</button>
  </form>
</div>