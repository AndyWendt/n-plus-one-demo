<?php

/**
 * @param \Illuminate\Contracts\Support\Arrayable|array $collection
 * @param \App\Contracts\Transformer       $transformer
 *
 * @return \Illuminate\Support\Collection
 */
function transform_collection($collection, \App\Contracts\Transformer $transformer)
{
    $out = [];

    foreach ($collection as $item) {
        $out[] = $transformer->transform($item);
    }

    return collect($out);
}