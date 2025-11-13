<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ItemSpec extends Model
{
    use HasFactory;

    protected $fillable = ['item_id', 'spec_key', 'spec_value', 'sort_order'];

    public function item()
    {
        return $this->belongsTo(Item::class);
    }
}
