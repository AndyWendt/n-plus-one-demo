<?php

namespace App\Chapter;


use App\Contracts\Transformer;

class ChapterTransformer implements Transformer
{
    public function transform($chapter)
    {
        return [
            'name' => $chapter->name,
            'book_id' => $chapter->book_id,
            'text' => $chapter,
        ];
    }
}