<?php

namespace App\Http\Controllers;

use App\Models\Guru; // Import model Guru
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GuruController extends Controller
{
    public function index()
    {
        $teachers = Guru::latest()->paginate(12);
        return view('admin.guru.index', compact('teachers'));
    }

    public function create()
    {
        return view('admin.guru.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|digits:12|unique:guru,nip',
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $fotoPath = null;
        if ($request->hasFile('foto')) {
            $fotoPath = $request->file('foto')->store('teachers', 'public');
        }

        Guru::create([
            'nama' => $request->nama,
            'nip' => $request->nip,
            'jabatan' => $request->jabatan,
            'foto' => $fotoPath,
        ]);

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $teacher = Guru::findOrFail($id);
        return view('admin.guru.edit', compact('teacher'));
    }

    public function update(Request $request, $id)
    {
        $teacher = Guru::findOrFail($id);

        $request->validate([
            'nama' => 'required|string|max:255',
            'nip' => 'nullable|string|digits:12|unique:guru,nip,' . $id,
            'jabatan' => 'required|string|max:255',
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('foto')) {
            if ($teacher->foto) {
                Storage::disk('public')->delete($teacher->foto);
            }
            $teacher->foto = $request->file('foto')->store('teachers', 'public');
        }

        $teacher->nama = $request->nama;
        $teacher->nip = $request->nip;
        $teacher->jabatan = $request->jabatan;
        $teacher->save();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $teacher = Guru::findOrFail($id);
        if ($teacher->foto) {
            Storage::disk('public')->delete($teacher->foto);
        }
        $teacher->delete();

        return redirect()->route('admin.guru.index')->with('success', 'Data guru berhasil dihapus!');
    }
}