<?php

namespace App\Publisher;


use App\Contracts\Transformer;

class PublisherTransformer implements Transformer
{
    public function transform($publisher)
    {
        return [
            'name' => $publisher->name,
            'authors' => null,
        ];
    }
}