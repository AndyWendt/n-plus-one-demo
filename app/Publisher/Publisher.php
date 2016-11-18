<?php

namespace App\Publisher;

use App\Author\Author;
use Illuminate\Database\Eloquent\Model;

class Publisher extends Model
{
    public function authors()
    {
        return $this->hasMany(Author::class);
    }
}
