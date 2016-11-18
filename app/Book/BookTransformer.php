<?php

namespace App\Book;


use App\Chapter\ChapterTransformer;
use App\Contracts\Transformer;

class BookTransformer implements Transformer
{
    /**
     * @var ChapterTransformer
     */
    private $chapterTransformer;

    public function __construct(ChapterTransformer $chapterTransformer)
    {
        $this->chapterTransformer = $chapterTransformer;
    }

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