<?php
namespace App\Livewire\Bookings;
use Livewire\Component;
use App\Models\Booking;
use Illuminate\Support\Str;

class CreateBooking extends Component {
    public $form = [
        'customer_id' => null,
        'start_at' => '',
        'end_at' => '',
        'delivery_method' => 'pickup',
        'address_id' => null,
        'notes' => null,
        'agreed_total' => 0,
        'deposit_paid' => 0,
    ];

    protected $rules = [
        'form.customer_id' => 'required|integer|exists:customers,id',
        'form.start_at' => 'required|date',
        'form.end_at' => 'required|date|after:form.start_at',
        'form.delivery_method' => 'required|in:pickup,delivery',
        'form.address_id' => 'nullable|integer|exists:addresses,id',
        'form.notes' => 'nullable|string',
        'form.agreed_total' => 'required|numeric|min:0',
        'form.deposit_paid' => 'required|numeric|min:0',
    ];

    public function submit(){
        $this->validate();
        $b = Booking::create([
            'code' => 'REC-'.now()->format('Ymd').'-'.Str::padLeft((string)random_int(1,999999),6,'0'),
            'customer_id' => $this->form['customer_id'],
            'status' => 'pending',
            'start_at' => $this->form['start_at'],
            'end_at' => $this->form['end_at'],
            'address_id' => $this->form['address_id'],
            'delivery_method' => $this->form['delivery_method'],
            'delivery_fee' => 0,
            'notes' => $this->form['notes'],
            'agreed_total' => $this->form['agreed_total'],
            'deposit_paid' => $this->form['deposit_paid'],
            'created_by_user_id' => auth()->id(),
        ]);
        session()->flash('ok','Reserva creada: '.$b->code);
        return redirect()->route('catalog');
    }

    public function render(){
        return view('livewire.bookings.create')
            ->layout('layouts.app', ['title' => 'Nueva reserva']);
    }
}