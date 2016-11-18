<?php

namespace App\Book;


use App\Contracts\Transformer;

class BookTransformer implements Transformer
{
    public function transform($book)
    {
        return [
            'name' => $book->name,
            'author_id' => $book->author_id,
            'chapters' => null,
        ];
    }
}