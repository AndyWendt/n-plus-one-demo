<?php

namespace App\Book;


use App\Contracts\Transformer;

class BookTransformer implements Transformer
{
    /**
     * @param Book $book
     * @return array
     */
    public function transform($book)
    {
        return [
            'name' => $book->name,
            'author_id' => $book->author_id,
            'chapters' => null,
        ];
    }
}