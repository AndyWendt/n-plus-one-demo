<?php

namespace App\Author;


use App\Contracts\Transformer;

class AuthorTransformer implements Transformer
{
    public function transform($author)
    {
        return [
            'name' => $author->name,
            'publisher_id' => $author->publisher_id,
            'books' => null,
        ];
    }
}