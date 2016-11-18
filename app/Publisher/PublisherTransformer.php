<?php

namespace App\Publisher;


use App\Author\AuthorTransformer;
use App\Contracts\Transformer;

class PublisherTransformer implements Transformer
{
    /**
     * @var AuthorTransformer
     */
    private $authorTransformer;

    public function __construct(AuthorTransformer $authorTransformer)
    {
        $this->authorTransformer = $authorTransformer;
    }

    /**
     * @param Publisher $publisher
     * @return array
     */
    public function transform($publisher)
    {
        return [
            'name' => $publisher->name,
            'authors' => null,
        ];
    }
}