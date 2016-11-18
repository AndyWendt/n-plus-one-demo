<?php

namespace App\Http\Controllers;

use App\Publisher\Publisher;
use App\Publisher\PublisherTransformer;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index(PublisherTransformer $publisherTransformer)
    {
        $publishers = Publisher::all();
        return response()->json(transform_collection($publishers, $publisherTransformer));
    }
}
