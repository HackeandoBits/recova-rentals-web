<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingsController extends Controller
{
    public function store(Request $r)
    {
        $data = $r->validate([
            'customer_id'   => 'required|integer|exists:customers,id',
            'start_at'      => 'required|date',
            'end_at'        => 'required|date|after:start_at',
            'delivery_method'=> 'required|in:pickup,delivery',
            'address_id'    => 'nullable|integer|exists:addresses,id',
            'notes'         => 'nullable|string',
            'agreed_total'  => 'required|numeric|min:0',
            'deposit_paid'  => 'required|numeric|min:0',
        ]);

        $booking = Booking::create([
            'code' => 'REC-'.now()->format('Ymd').'-'.Str::padLeft((string)random_int(1,999999),6,'0'),
            'status' => 'pending',
            'created_by_user_id' => $r->user()->id,
        ] + $data);

        return response()->json($booking->fresh(), 201);
    }
}
