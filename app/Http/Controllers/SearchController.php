<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $texto = $request->get('texto');

        // leer dataset
        $data = json_decode(file_get_contents(base_path('dataset.json')), true);

        $books = [];
        $authors = [];

        foreach ($data as $book) {

            // buscar coincidencias en titulo o autor
            if (
                stripos($book['titulo'], $texto) !== false ||
                stripos($book['autor'], $texto) !== false
            ) {
                $books[] = $book;
            }
        }

        // obtener autores únicos
        $authorNames = array_unique(array_column($data, 'autor'));

        foreach ($authorNames as $authorName) {

            if (stripos($authorName, $texto) !== false) {

                // libros del autor
                $authorBooks = array_filter($data, function ($book) use ($authorName) {
                    return $book['autor'] === $authorName;
                });

                // ordenar por fecha_nov desc
                usort($authorBooks, function ($a, $b) {
                    return $b['fecha_nov'] <=> $a['fecha_nov'];
                });

                $authors[] = [
                    "nombre" => $authorName,
                    "last_books" => array_slice(array_values($authorBooks), 0, 2)
                ];
            }
        }

        return response()->json([
            "books" => $books,
            "authors" => $authors
        ]);
    }
}
