<?php

namespace Tests\Feature\Livewire;

use App\Livewire\Cart\CartModal;
use Illuminate\Support\Facades\Http;
use Livewire\Livewire;
use Tests\TestCase;

class CartSubmissionTest extends TestCase
{
    public function test_can_submit_cart_successfully(): void
    {
        // Mock de la API del Admin
        Http::fake([
            env('ADMIN_API_URL').'/api/v1/bookings' => Http::response(['message' => 'Booking created'], 201),
        ]);

        $items = [
            [
                'id' => 1,
                'name' => 'Item Test',
                'quantity' => 2,
                'category' => 'Test Cat',
                'image_url' => 'http://test.com/img.png',
            ],
        ];

        Livewire::test(CartModal::class)
            ->set('name', 'Juan Perez')
            ->set('email', 'juan@test.com')
            ->set('phone', '12345678')
            ->set('requestType', 'whatsapp')
            ->call('handleSubmit', $items)
            ->assertSet('success', true)
            ->assertSet('errorMessage', null)
            ->assertDispatched('budget-sent');

        // Verificar que se hizo la petición a la API con los datos correctos
        Http::assertSent(function ($request) use ($items) {
            return $request->url() == env('ADMIN_API_URL').'/api/v1/bookings' &&
                   $request['customer']['name'] == 'Juan Perez' &&
                   $request['items'] == $items &&
                   $request['request_type'] == 'whatsapp';
        });
    }

    public function test_validation_fails_if_fields_missing(): void
    {
        Livewire::test(CartModal::class)
            ->set('name', '') // Nombre vacío
            ->call('handleSubmit', [['id' => 1]])
            ->assertHasErrors(['name' => 'required']);
    }

    public function test_submission_fails_if_cart_is_empty(): void
    {
        Livewire::test(CartModal::class)
            ->set('name', 'Juan Perez')
            ->set('email', 'juan@test.com')
            ->set('phone', '12345678')
            ->set('requestType', 'whatsapp')
            ->call('handleSubmit', []) // Carrito vacío
            ->assertSet('errorMessage', 'El carrito está vacío.')
            ->assertSet('success', false);
    }
}
