<?php

namespace App\Http\Controllers;

use App\Models\role;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index()
    {
        $role = role::paginate(5);
        return view('page.role.index')->with([
            'role' => $role
        ]);
    }
    public function store(Request $request)
    {
        $data = [
            'nama' => $request->input('nama'),
        ];

        role::create($data);

        return back()->with('message_delete', 'Data Supplier Sudah dihapus');
    }
    
    public function update(Request $request, string $id)
    {
        $data = [
            'nama' => $request->input('nama'),
        ];

        $datas = role::findOrFail($id);
        $datas->update($data);
        return back()->with('message_delete', 'Data Supplier Sudah dihapus');
    }

    public function destroy($id)
    {
        $data = role::findOrFail($id);
        $data->delete();
        return back()->with('message_delete','Data Supplier Sudah dihapus');
    }
}
