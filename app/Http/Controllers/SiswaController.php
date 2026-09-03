<?php

namespace App\Http\Controllers;

use App\Models\Siswa;
use App\Models\Kelas; // Tambahkan import model Kelas
use Illuminate\Http\Request;

class SiswaController extends Controller
{
    public function index(Request $request)
    {
        // Menangkap input pencarian dari form
        $search = $request->input('search');

        // Melakukan filter pencarian jika ada input
        $siswas = Siswa::when($search, function ($query, $search) {
            return $query->where('nama', 'like', "%{$search}%")
                         ->orWhere('nisn', 'like', "%{$search}%")
                         ->orWhere('kelas', 'like', "%{$search}%");
        })
        ->latest()
        ->paginate(15) // Mempertahankan limit 15 data per halaman
        ->withQueryString(); // Memastikan parameter search tidak hilang saat pindah halaman (pagination)

        return view('admin.siswa.index', compact('siswas'));
    }

    public function create()
    {
        // Ambil semua data kelas untuk dropdown
        $kelasList = Kelas::orderBy('nama_kelas', 'asc')->get();
        
        return view('admin.siswa.create', compact('kelasList'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nisn'          => 'required|digits:10|unique:siswas,nisn',
            'nama'          => 'required|string|max:255',
            'kelas'         => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        Siswa::create($request->all());

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $siswa = Siswa::findOrFail($id);
        
        // Ambil semua data kelas untuk dropdown
        $kelasList = Kelas::orderBy('nama_kelas', 'asc')->get();
        
        return view('admin.siswa.edit', compact('siswa', 'kelasList'));
    }

    public function update(Request $request, $id)
    {
        $siswa = Siswa::findOrFail($id);

        $request->validate([
            'nisn'          => 'required|digits:10|unique:siswas,nisn,' . $id,
            'nama'          => 'required|string|max:255',
            'kelas'         => 'required|string|max:50',
            'jenis_kelamin' => 'required|in:L,P',
        ]);

        $siswa->update($request->all());

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $siswa = Siswa::findOrFail($id);
        $siswa->delete();

        return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil dihapus!');
    }
}