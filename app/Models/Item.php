<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Item extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'category_id','name','slug','description','stock','active'
    ];

    protected $casts = [
        'active' => 'boolean',
    ];

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function features() {
        return $this->hasMany(ItemFeature::class);
    }

    public function specs() {
        return $this->hasMany(ItemSpec::class);
    }

    public function combos() {
        return $this->belongsToMany(Combo::class, 'combo_item')->withPivot('quantity');
    }
}
