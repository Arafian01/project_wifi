<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        return response()->json([
            paket::all()
        ]);
    }
}
