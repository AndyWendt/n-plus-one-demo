<?php

namespace App\Http\Controllers;

use App\Publisher\Publisher;
use Illuminate\Http\Request;

class PublisherController extends Controller
{
    public function index()
    {
        return Publisher::all();
    }
}
