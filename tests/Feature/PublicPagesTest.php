<?php

namespace Tests\Feature;

use Tests\TestCase;

class PublicPagesTest extends TestCase
{
    public function test_public_pages_are_accessible_and_use_correct_views(): void
    {
        $pages = [
            // route name     => view name
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
