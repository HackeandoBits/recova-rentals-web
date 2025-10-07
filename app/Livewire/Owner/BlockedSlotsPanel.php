<?php
namespace App\Livewire\Owner;
use Livewire\Component;
use App\Models\BlockedSlot;

class BlockedSlotsPanel extends Component {
    public $start_at = '';
    public $end_at = '';
    public $reason = '';

    protected $rules = [
        'start_at' => 'required|date',
        'end_at' => 'required|date|after:start_at',
        'reason' => 'nullable|string',
    ];

    public function create(){
        $this->validate();
        BlockedSlot::create([
            'owner_user_id' => auth()->id(),
            'start_at' => $this->start_at,
            'end_at' => $this->end_at,
            'reason' => $this->reason,
            'source' => 'manual',
        ]);
        $this->reset(['start_at','end_at','reason']);
        session()->flash('ok','Bloqueo creado');
    }

    public function render(){
        $blocks = BlockedSlot::where('owner_user_id', auth()->id())
            ->orderByDesc('start_at')->limit(50)->get();
        return view('livewire.owner.blocks', compact('blocks'))
            ->layout('layouts.app', ['title' => 'Bloqueos del dueño']);
    }
}