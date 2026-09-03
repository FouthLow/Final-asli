<?php

namespace App\Http\Controllers;

use App\Models\Kelas;
use Illuminate\Http\Request;

class KelasController extends Controller
{
    public function index()
    {
        $kelasList = Kelas::orderBy('nama_kelas', 'asc')->paginate(10);
        return view('admin.kelas.index', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas'
        ]);
        Kelas::create(['nama_kelas' => $request->nama_kelas]);
        return redirect()->back()->with('success', 'Kelas baru berhasil ditambahkan!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nama_kelas' => 'required|string|max:50|unique:kelas,nama_kelas,' . $id
        ]);
        $kelas = Kelas::findOrFail($id);
        $kelas->update(['nama_kelas' => $request->nama_kelas]);
        return redirect()->back()->with('success', 'Kelas berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $kelas = Kelas::findOrFail($id);
        $kelas->delete();
        return redirect()->back()->with('success', 'Kelas berhasil dihapus!');
    }
}