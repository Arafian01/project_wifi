<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        return response()->json([
            'message' => 'Hello from Laravel API!',
            'data' => [
                'name' => 'John Doe',
                'email' => 'john@example.com'
            ]
        ]);
    }
}
