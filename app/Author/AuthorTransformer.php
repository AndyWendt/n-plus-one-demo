<?php

namespace App\Author;


use App\Book\BookTransformer;
use App\Contracts\Transformer;

class AuthorTransformer implements Transformer
{
    /**
     * @var BookTransformer
     */
    private $bookTransformer;

    public function __construct(BookTransformer $bookTransformer)
    {
        $this->bookTransformer = $bookTransformer;
    }

    /**
     * @param Author $author
     * @return array
     */
    public function transform($author)
    {
        return [
            'name' => $author->name,
            'publisher_id' => $author->publisher_id,
            'books' => transform_collection($author->books, $this->bookTransformer),
        ];
    }
}