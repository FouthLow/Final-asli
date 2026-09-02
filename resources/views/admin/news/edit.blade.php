<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Berita - Admin Galeri</title>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100 min-h-screen p-6">

    <div class="max-w-2xl mx-auto bg-white rounded-xl shadow-sm border border-gray-100 p-8">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-xl font-bold text-gray-800">Edit Berita / Foto</h2>
            <a href="{{ route('admin.news.index') }}" class="text-sm text-gray-500 hover:text-gray-700">← Kembali</a>
        </div>

        @if ($errors->any())
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-6 text-sm">
                <ul class="list-disc pl-5">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('admin.news.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" class="space-y-5">
            @csrf
            @method('PUT')

            <div>
                <label for="judul" class="block text-sm font-medium text-gray-700 mb-1">Judul Berita / Foto</label>
                <input type="text" id="judul" name="judul" value="{{ old('judul', $gallery->judul) }}" required 
                       class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
            </div>

            <div>
                <label for="category_id" class="block text-sm font-medium text-gray-700 mb-1">Kategori</label>
                <select id="category_id" name="category_id" required 
                        class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">
                    @foreach ($categories as $cat)
                        <option value="{{ $cat->id }}" {{ old('category_id', $gallery->category_id ?? $gallery->kategori_id) == $cat->id ? 'selected' : '' }}>
                            {{ $cat->nama ?? $cat->name }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div>
                <label for="deskripsi" class="block text-sm font-medium text-gray-700 mb-1">Deskripsi (Opsional)</label>
                <textarea id="deskripsi" name="deskripsi" rows="3" 
                          class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:ring-2 focus:ring-indigo-500 focus:outline-none">{{ old('deskripsi', $gallery->deskripsi) }}</textarea>
            </div>

            <div>
                <label class="block text-sm font-medium text-gray-700 mb-1">Gambar Saat Ini</label>
                <img src="{{ asset('storage/' . $gallery->gambar) }}" alt="{{ $gallery->judul }}" class="w-32 h-24 object-cover rounded-lg mb-2">
                
                <label for="gambar" class="block text-sm font-medium text-gray-700 mb-1">Ganti Gambar (Biarkan kosong jika tidak ingin mengubah)</label>
                <input type="file" id="gambar" name="gambar" accept="image/*" 
                       class="w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-lg file:border-0 file:text-sm file:font-semibold file:bg-indigo-50 file:text-indigo-700 hover:file:bg-indigo-100">
            </div>

            <div class="pt-4 flex justify-end gap-3">
                <a href="{{ route('admin.news.index') }}" class="px-4 py-2 border rounded-lg text-gray-600 hover:bg-gray-50 text-sm font-medium">Batal</a>
                <button type="submit" class="px-4 py-2 bg-indigo-600 hover:bg-indigo-700 text-white rounded-lg text-sm font-medium transition">Simpan Perubahan</button>
            </div>
        </form>
    </div>

</body>
</html>