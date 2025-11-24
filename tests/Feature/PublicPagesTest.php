<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function public_pages_are_accessible_and_use_correct_views(): void
    {
        $this->seed();

        $pages = [
            'home' => 'pages.home',
            'catalog' => 'pages.products',
            'gallery' => 'pages.gallery',
            'location' => 'pages.location',
            'about' => 'pages.about',
        ];

        foreach ($pages as $routeName => $viewName) {
            $response = $this->get(route($routeName));

            $response->assertStatus(200);
            $response->assertViewIs($viewName);
        }
    }
}
