<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Cart\CartManager;
use App\Models\Category;
use App\Models\Item;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class CartManagerTest extends TestCase
{
    use RefreshDatabase;

    private function createItem(): Item
    {
        $category = Category::create([
            'name' => 'Pantallas LED',
            'slug' => 'pantallas-led',
            'description' => 'Categoría de prueba',
            'parent_id' => null,
        ]);

        return Item::create([
            'category_id' => $category->id,
            'name' => 'Pantalla LED 3x2',
            'slug' => 'pantalla-led-p29-indoor-3x2m',
            'description' => 'Item de prueba para el carrito',
            'stock' => 5,
            'active' => true,
        ]);
    }

    public function test_can_add_item_to_cart(): void
    {
        $item = $this->createItem();

        $component = Livewire::test(CartManager::class);

        // Llamamos directamente al método público addToCart
        $component->call('addToCart', $item->id);

        // El contador del carrito se actualiza
        $component->assertSet('cartCount', 1);

        // El array interno del carrito tiene el ítem correcto
        $cartItems = $component->get('cartItems');

        $this->assertArrayHasKey($item->id, $cartItems);
        $this->assertEquals($item->name, $cartItems[$item->id]['name']);
        $this->assertEquals(1, $cartItems[$item->id]['quantity']);

        // También se guarda en la sesión
        $this->assertEquals($cartItems, session('cart'));
    }

    public function test_can_remove_item_from_cart(): void
    {
        $item = $this->createItem();

        $component = Livewire::test(CartManager::class);

        // Primero lo agregamos
        $component->call('addToCart', $item->id);

        // Luego lo removemos
        $component->call('removeFromCart', $item->id);

        $component->assertSet('cartCount', 0);

        $cartItems = $component->get('cartItems');
        $this->assertArrayNotHasKey($item->id, $cartItems);
        $this->assertEquals([], session('cart'));
    }
}
