<?php

namespace App\Http\Controllers;

use App\Models\paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        $paket = paket::paginate(5);
        return view('page.paket.index')->with([
            'paket' => $paket
        ]);
    }
}
