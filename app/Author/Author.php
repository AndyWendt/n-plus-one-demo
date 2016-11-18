<?php

namespace App\Author;

use App\Book\Book;
use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    public function books()
    {
        return $this->hasMany(Book::class);
    }
}
