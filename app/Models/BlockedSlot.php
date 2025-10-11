<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class BlockedSlot extends Model
{
    use HasFactory;
    protected $fillable = [
        'owner_user_id','date_from','date_to','reason','source'
    ];

    protected $casts = [
        'date_from' => 'date',
        'date_to'   => 'date',
    ];

    public function owner() {
        return $this->belongsTo(User::class, 'owner_user_id');
    }
}
