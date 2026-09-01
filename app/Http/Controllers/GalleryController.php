<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GalleryController extends Controller
{
    public function index()
    {
        $galleries = Gallery::with('category')->latest()->paginate(10);
        $totalGalleries = Gallery::count();
        $totalCategories = Category::count();

        return view('admin.dashboard', compact('galleries', 'totalGalleries', 'totalCategories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.galleries.create', compact('categories'));
    }

    public function store(Request $request)
    {
        // 1. Validasi Input (Pastikan nama key sama persis dengan atribut 'name' di form HTML)
        $request->validate([
            'judul' => 'required|string|max:255',
            'kategori_id' => 'required|exists:categories,id', // Perbaikan typo 'ketegori_id'
            'deskripsi' => 'nullable|string',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        // 2. Upload Gambar (Ambil input 'gambar')
        $imagePath = $request->file('gambar')->store('galleries', 'public');

        // 3. Simpan ke Database
        Gallery::create([
            'judul' => $request->judul,
            'kategori_id' => $request->kategori_id,
            'deskripsi' => $request->deskripsi,
            'gambar' => $imagePath,
            'user_id' => auth()->id(),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Foto berhasil ditambahkan!');
    }

    // 5. Form Edit Foto
    public function edit(Gallery $gallery)
    {
        $categories = Category::all();
        return view('admin.galleries.edit', compact('gallery', 'categories'));
    }

    // 6. Proses Update Foto
    public function update(Request $request, Gallery $gallery)
    {
        // Validasi input (gambar jadi opsional/nullable pas edit)
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

        // Jika user mengunggah gambar baru
        if ($request->hasFile('gambar')) {
            // Hapus gambar lama dari storage
            if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
                Storage::disk('public')->delete($gallery->gambar);
            }

            // Upload gambar baru
            $data['gambar'] = $request->file('gambar')->store('galleries', 'public');
        }

        $gallery->update($data);

        return redirect()->route('admin.dashboard')->with('success', 'Foto berhasil diperbarui!');
    }

    public function destroy(Gallery $gallery)
    {
        // Sesuaikan dengan nama kolom database ($gallery->gambar)
        if ($gallery->gambar && Storage::disk('public')->exists($gallery->gambar)) {
            Storage::disk('public')->delete($gallery->gambar);
        }

        $gallery->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Foto berhasil dihapus!');
    }
}