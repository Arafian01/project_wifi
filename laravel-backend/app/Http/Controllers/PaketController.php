<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;

class PaketController extends Controller
{
    public function index()
    {
        return Paket::all();
    }

    public function store(Request $request)
    {
        $paket = Paket::create($request->all());
        return response()->json($paket, 201);
    }

    public function show($id)
    {
        return Paket::findOrFail($id);
    }

    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);
        $paket->update($request->all());
        return response()->json($paket, 200);
    }

    public function destroy($id)
    {
        Paket::destroy($id);
        return response()->json(null, 204);
    }
}
