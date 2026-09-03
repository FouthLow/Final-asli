<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use App\Models\Guru;  // Tambahkan import Guru
use App\Models\Siswa; // Tambahkan import Siswa
use App\Models\Kelas; // Tambahkan import Kelas
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        // Data Galeri & Kategori bawaan aslimu
        $galleries = Gallery::with('category')->latest()->paginate(10);
        $totalGalleries = Gallery::count();
        $totalCategories = Category::count();

        // Tambahan data dinamis untuk 3 kartu di Dashboard
        $totalGuru = Guru::count();
        $totalSiswa = Siswa::count();
        $totalKelas = Kelas::count();

        // Masukkan variabel baru ke dalam compact()
        return view('admin.dashboard', compact(
            'galleries', 'totalGalleries', 'totalCategories', 
            'totalGuru', 'totalSiswa', 'totalKelas'
        ));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $request->file('gambar')->store('galleries', 'public');

        Gallery::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Foto berhasil ditambahkan!');
    }

    public function edit(Gallery $gallery)
    {
        $categories = Category::all();
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, Gallery $gallery)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id',
            'deskripsi' => 'nullable|string',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $data = [
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
        ];

        if ($request->hasFile('gambar')) {
            if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
                Storage::disk('public')->delete($gallery->gambar);
            }
            $data['gambar'] = $request->file('gambar')->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
            Storage::disk('public')->delete($gallery->gambar);
        }

        $gallery->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Foto berhasil dihapus!');
    }

    public function publicIndex(Request $request)
    {
        $categories = Category::all();

        $galleries = Gallery::with('category')
            ->when($request->filled('kategori'), function ($query) use ($request) {
                $query->whereHas('category', function ($q) use ($request) {
                    $q->where('slug', $request->kategori);
                });
            })
            ->latest()
            ->paginate(9);

        $galleries->appends($request->all());

        return view('gallery', compact('galleries', 'categories'));
    }

    public function show($id)
    {
        $gallery = Gallery::with('category')->findOrFail($id);
        return view('gallery.show', compact('gallery'));
    }
}