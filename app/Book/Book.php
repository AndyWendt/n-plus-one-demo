<?php

namespace App\Book;

use App\Chapter\Chapter;
use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function chapters()
    {
        return $this->hasMany(Chapter::class);
    }
}
