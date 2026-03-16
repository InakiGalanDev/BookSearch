<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthorLastBooksTest extends TestCase
{
    public function test_authors_include_last_books()
    {
        $response = $this->get('/api/search?texto=jorge');

        $response->assertStatus(200);

        $response->assertJsonStructure([
            'authors' => [
                '*' => [
                    'nombre',
                    'last_books'
                ]
            ]
        ]);
    }

    public function test_last_books_max_two()
    {
        $response = $this->get('/api/search?texto=jorge');

        $data = $response->json();

        foreach ($data['authors'] as $author) {
            $this->assertLessThanOrEqual(2, count($author['last_books']));
        }
    }
}
