<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    //
    public function index()
    {
        Log::info("Jay");
    }

    public function meow()
    {
        return response()->json([
            "cat" => "meow"
        ]);
    }
}
