<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        $query = Gallery::with('category');

        if ($request->has('kategori') && $request->kategori != '') {
            $query->whereHas('category', function ($q) use ($request) {
                $q->where('slug', $request->kategori);
            });
        }

        $galleries = $query->latest()->paginate(12);
        $categories = Category::all();

        return view('admin.news.index', compact('galleries', 'categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.news.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'judul' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'required|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        $imagePath = $request->file('gambar')->store('galleries', 'public');

        Gallery::create([
            'judul' => $request->judul,
            'category_id' => $request->category_id,
            'gambar' => $imagePath,
        ]);

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil ditambahkan!');
    }

    public function edit($id)
    {
        $gallery = Gallery::findOrFail($id);
        $categories = Category::all();
        return view('admin.news.edit', compact('gallery', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $gallery = Gallery::findOrFail($id);

        $request->validate([
            'judul' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'gambar' => 'nullable|image|mimes:jpeg,png,jpg,webp|max:2048',
        ]);

        if ($request->hasFile('gambar')) {
            if ($gallery->gambar) {
                Storage::disk('public')->delete($gallery->gambar);
            }
            $gallery->gambar = $request->file('gambar')->store('galleries', 'public');
        }

        $gallery->judul = $request->judul;
        $gallery->category_id = $request->category_id;
        $gallery->save();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil diperbarui!');
    }

    public function destroy($id)
    {
        $gallery = Gallery::findOrFail($id);
        if ($gallery->gambar) {
            Storage::disk('public')->delete($gallery->gambar);
        }
        $gallery->delete();

        return redirect()->route('admin.news.index')->with('success', 'Berita berhasil dihapus!');
    }
}