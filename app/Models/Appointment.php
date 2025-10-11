<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    protected $fillable = [
        'booking_id',
        'assigned_user_id',
        'starts_at',
        'ends_at',
        'channel',
        'location_note',
        'status',
    ];

    protected $casts = [
        'starts_at' => 'datetime',
        'ends_at'   => 'datetime',
    ];

    public function booking()
    {
        return $this->belongsTo(Booking::class);
    }

    public function assignee()
    {
        return $this->belongsTo(User::class, 'assigned_user_id');
    }

    public function scopeForUserBetween($q, int $userId, $from, $to) {
    return $q->where('assigned_user_id',$userId)
             ->where('starts_at','<',$to)
             ->where('ends_at','>',$from);
    }

    public function scopeOnDate($q, \Carbon\Carbon|string $date) {
    $d = \Illuminate\Support\Carbon::parse($date);
    return $q->whereDate('starts_at', $d->toDateString());
}

}