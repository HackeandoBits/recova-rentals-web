<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Combo extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = ['name', 'slug', 'active'];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'combo_item')->withPivot('quantity');
    }
}
