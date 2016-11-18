<?php

namespace App\Publisher;


use App\Contracts\Transformer;

class PublisherTransformer implements Transformer
{
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