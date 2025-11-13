<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;

class ItemsController extends Controller
{
    public function index(Request $r)
    {
        $q = Item::query()->with('images', 'categories')->where('active', true);
        if ($r->filled('q')) {
            $q->where('name', 'like', "%{$r->q}%");
        }

        return $q->paginate(12);
    }

    public function show(Item $item)
    {
        $item->load('images', 'categories');

        return $item;
    }
}
