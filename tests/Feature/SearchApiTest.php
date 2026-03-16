<?php

namespace Tests\Feature;

use Tests\TestCase;

class SearchApiTest extends TestCase
{
    public function test_search_endpoint_returns_structure()
    {
        $response = $this->get('/api/search?texto=jorge');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'books',
            'authors'
        ]);
    }

    public function test_search_finds_books_by_title()
    {
        $response = $this->get('/api/search?texto=Melodrama');

        $response->assertStatus(200);

        $response->assertJsonFragment([
            'titulo' => 'Melodrama'
        ]);
    }

    public function test_search_finds_authors()
    {
        $response = $this->get('/api/search?texto=Jorge');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'authors'
        ]);
    }
}
