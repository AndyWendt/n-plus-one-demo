<?php

namespace App\Http\Controllers;

use App\Publisher\Publisher;
use App\Publisher\PublisherTransformer;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index(PublisherTransformer $publisherTransformer)
    {
        $publishers = Publisher::with('authors.books.chapters')->get();
        return response()->json(transform_collection($publishers, $publisherTransformer));
    }
}
